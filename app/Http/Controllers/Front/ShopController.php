<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Favourite;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductComment;
use App\Services\Brand\BrandServiceInterface;
use App\Services\Product\ProductServiceInterface;
use App\Services\ProductCategory\ProductCategoryServiceInterface;
use App\Services\ProductComment\ProductCommentServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ShopController extends Controller
{
    private $productService;
    private $productCommentService;

    private $productCategoryService;
    private $brandService;
    public function __construct(ProductServiceInterface $productService,
                                ProductCommentServiceInterface $productCommentService,
                                ProductCategoryServiceInterface $productCategoryService,
                                BrandServiceInterface $brandService)
    {
        $this->productService = $productService;
        $this->productCommentService = $productCommentService;
        $this->productCategoryService = $productCategoryService;
        $this->brandService = $brandService;
    }

    public function show($id)
    {
        $product = $this->productService->find($id);
        $relatedProducts = $this->productService->getRelatedProducts($product);
        $productRating = $this->productCommentService->all();
        $productComments = $product->productComments()->paginate(5); // Phân trang các comment của sản phẩm
        $avgRating = $product->productComments()->avg('rating');
        $locale = Session()->get('locale');
        $favouriteCount = 0;
        $user = Auth::user();
        if (Auth::check()) {
            $userId = Auth::id();
            $favouriteCount = Favourite::where('user_id', $userId)->count();
        }

        // Kiểm tra xem người dùng đã mua sản phẩm này chưa
        $hasPurchased = false;
        $orderInfo = null;
        if ($user) {
            $orderInfo = Order::where('user_id', $user->id)
                ->whereHas('orderDetails', function ($query) use ($id) {
                    $query->where('product_id', $id);
                })
                ->first();

            if ($orderInfo) {
                $hasPurchased = true;
            }

        }

        // Lấy tất cả các đơn hàng liên quan đến sản phẩm
        $orders = Order::whereHas('orderDetails', function ($query) use ($id) {
            $query->where('product_id', $id);
        })->get();

        // Khởi tạo mảng để lưu thông tin về size và color của mỗi người dùng
        $userOrderDetails = [];

        // Lặp qua từng đơn hàng
        foreach ($orders as $order) {
            // Lặp qua từng chi tiết đơn hàng của đơn hàng hiện tại
            foreach ($order->orderDetails as $detail) {
                // Kiểm tra nếu sản phẩm của chi tiết đơn hàng trùng với sản phẩm hiện tại
                if ($detail->product_id == $id) {
                    // Lưu thông tin về size và color vào mảng $userOrderDetails theo user_id
                    $userOrderDetails[$order->user_id][] = [
                        'size' => $detail->size,
                        'color' => $detail->color
                    ];
                }
            }
        }


        // Tính avgRating cho các sản phẩm liên quan
        foreach ($relatedProducts as $relatedProduct) {
            $relatedProduct->avgRating = $relatedProduct->productComments()->avg('rating');
        }

        // Lấy các bình luận của sản phẩm và phân trang
        $productComments = $product->productComments()->paginate(5);

        if ($user) {
            $userId = $user->id;

            // Tách bình luận của người dùng hiện tại và các bình luận khác
            $currentUserComments = $productComments->where('user_id', $userId);
            $otherUserComments = $productComments->where('user_id', '!=', $userId);

            // Hợp nhất các bình luận, đưa bình luận của người dùng hiện tại lên đầu
            $sortedComments = $currentUserComments->merge($otherUserComments);

            // Tạo một LengthAwarePaginator mới từ các bình luận đã sắp xếp
            $productComments = new \Illuminate\Pagination\LengthAwarePaginator(
                $sortedComments,
                $productComments->total(),
                $productComments->perPage(),
                $productComments->currentPage(),
                ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
            );
        }

        // Kiểm tra xem người dùng đã có bình luận cho sản phẩm này chưa
        $hasCommented = false;
        if ($user) {
            $hasCommented = ProductComment::where('product_id', $id)
                ->where('user_id', $user->id)
                ->exists();
        }
        $favourites = [];
        if (Auth::check()) {
            $userId = Auth::id();
            $favourites = Favourite::where('user_id', $userId)->pluck('product_id')->toArray();
        }


        return view('front.shop.product-details',compact('product','orderInfo','userOrderDetails','hasPurchased','productComments','favourites','avgRating','user', 'hasCommented','relatedProducts','productRating','locale','favouriteCount'));
    }

    public function postComment(Request $request)
    {

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'messages' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);


        $user = Auth::user();


        $comment = ProductComment::where('product_id', $request->product_id)
            ->where('user_id', $user->id)
            ->first();

        if ($comment) {
            // Cập nhật bình luận cũ
            $comment->name = $request->name;
            $comment->email = $request->email;
            $comment->messages = $request->messages ?? $comment->messages;
            $comment->rating = $request->rating ?? $comment->rating;
            $comment->save();
        } else {
            // Tạo bình luận mới nếu không tìm thấy bình luận cũ
            $comment = new ProductComment();
            $comment->product_id = $request->product_id;
            $comment->user_id = $user->id;
            $comment->name = $request->name;
            $comment->email = $request->email;
            $comment->messages = $request->messages;
            $comment->rating = $request->rating;
            $comment->save();
        }


        if ($request->has('name') && $user->name !== $request->name) {
            $user->name = $request->name;
        }
        if ($request->has('email') && $user->email !== $request->email) {
            $user->email = $request->email;
        }


        $user->save();



        return redirect()->back()->with('success', 'Bình luận và thông tin người dùng đã được cập nhật thành công!');
    }

    public function deleteComment($id)
    {
        $comment = ProductComment::findOrFail($id);

        if (Auth::id() !== $comment->user_id) {
            return redirect()->back()->with('error', 'Bạn không có quyền xóa bình luận này.');
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Bình luận đã được xóa thành công.');
    }


    public function index(Request $request)
    {
        $productRating = $this->productCommentService->all();
        $categories = $this->productCategoryService->all();
        $brands = $this->brandService->all();




        // Lấy tham số lọc giá từ yêu cầu
        $priceMin = $request->input('price_min');
        $priceMax = $request->input('price_max');

        $products = $this->productService->getProductOnIndex($request,$priceMin,$priceMax);
        foreach ($products as $product) {
            $product->avgRating = $product->productComments()->avg('rating');
        }

        $locale = Session()->get('locale');
        $favouriteCount = 0;
        if (Auth::check()) {
            $userId = Auth::id();
            $favouriteCount = Favourite::where('user_id', $userId)->count();
        }
        $favourites = [];
        if (Auth::check()) {
            $userId = Auth::id();
            $favourites = Favourite::where('user_id', $userId)->pluck('product_id')->toArray();
        }


        return view('front.shop.index',compact("products","categories","brands",'productRating','locale','favourites','favouriteCount'));
    }

    public function quickView(Request $request)
    {
        if ($request->ajax()) {
            $productId = $request->get('product_id');
//            $product = Product::with(['productImages', 'productDetails', 'productComments'])->findOrFail($productId);
            $product = $this->productService->find($productId);
            return response()->json([
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'discount' => $product->discount,
                'images' => $product->productImages->toArray(),
                'avgRating' => $product->avgRating,
                'reviewsCount' => count($product->productComments),
                'sizes' => array_unique(array_column($product->productDetails->toArray(), 'size')),
                'colors' => array_unique(array_column($product->productDetails->toArray(), 'color')),
                'sku' => $product->sku,
                'category' => $product->productCategory->name,
                'brand' => $product->brand->name,
                'tag' => $product->tag,
                'id' => $product->id,
            ]);
        }
        return back();
    }

    public function getProductDetails(Request $request)
    {
        $productId = $request->input('productId');
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $sizes = $product->productDetails->pluck('size')->unique();
        $colors = $product->productDetails->pluck('color')->unique();

        return response()->json([
            'sizes' => $sizes,
            'colors' => $colors
        ]);
    }



    public function category($categoryName, Request $request)
    {
        $categories = $this->productCategoryService->all();
        $brands = $this->brandService->all();
        $productRating = $this->productCommentService->all();
        $locale = Session()->get('locale');
        $favouriteCount = 0;
        if (Auth::check()) {
            $userId = Auth::id();
            $favouriteCount = Favourite::where('user_id', $userId)->count();
        }

        $favourites = [];
        if (Auth::check()) {
            $userId = Auth::id();
            $favourites = Favourite::where('user_id', $userId)->pluck('product_id')->toArray();
        }

        // Lấy tham số lọc giá từ yêu cầu
        $priceMin = $request->input('price_min');
        $priceMax = $request->input('price_max');


        $products = $this->productService->getProductsByCategory($categoryName,$request, $priceMin, $priceMax);
        return view('front.shop.index',compact("products","categories","brands","favourites","productRating",'locale','favouriteCount'));
    }



}
