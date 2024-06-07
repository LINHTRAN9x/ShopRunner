<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Favourite;
use App\Models\ProductDetail;
use App\Services\Product\ProductServiceInterface;
use Eelcol\LaravelBootstrapAlerts\Facade\BootstrapAlerts;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    private $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $carts = Cart::content();

        $total = Cart::total();
        $subTotal = Cart::subtotal();
        $locale = Session()->get('locale');

        $favouriteCount = 0;
        if (Auth::check()) {
            $userId = Auth::id();
            $favouriteCount = Favourite::where('user_id', $userId)->count();
        }

        return view('front.shop.cart',compact('carts','total','subTotal','locale','favouriteCount'));
    }

    public function add(Request $request)
    {
        if ($request->ajax()){
            $product = $this->productService->find($request->productId);
            $qty = $request->input('qty', 1);
            $size = $request->input('size'); // Lấy k
            $color = $request->input('color');
            $quickviewcolor = $request->input('quick-view-color');


            $response['cart'] = Cart::add([
                'id'=>$product->id,
                'name'=>$product->name,
                'qty'=>$qty, // Sử dụng số lượng từ yêu cầu,
                'price'=>$product->discount ?? $product->price,
                'weight'=>$product->weight ?? 0,
                'options' => [
                    'images' => $product->productImages,
                    'size' =>  $size,// Thêm kích thước vào tùy chọn của sản phẩm
                    'color'=> $color,
                    'quick-view-color' => $quickviewcolor,
                ]
            ]);
            $response['count'] = Cart::count();
            $response['total'] = Cart::total();

            return $response;

        }


        return back();
    }
    public function delete(Request $request)
    {
        if($request->ajax()){
            $response['cart'] = Cart::remove($request->rowId);

            $response['count'] = Cart::count();
            $response['total'] = Cart::total();
            $response['subTotal'] = Cart::subtotal();

            return $response;
        }

        return back();
    }

    public function destroyCart()
    {
        Cart::destroy();
    }
    public function update(Request $request)
    {
        if ($request->ajax()){
            $response['cart'] = Cart::update($request->rowId,$request->qty);

            $response['count'] = Cart::count();
            $response['total'] = Cart::total();
            $response['subTotal'] = Cart::subtotal();

            return $response;
        }
    }

    public function cartQuickView(Request $request)
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

    public function updateProduct(Request $request)
    {
        if ($request->ajax()) {

            $productId = $request->productId;
            $qty = $request->qty;
            $size = $request->size;
            $color = $request->color;
            $rowId = $request->rowId;
            $oldProduct = Cart::get($rowId);

            // Cập nhật thông tin sản phẩm trong giỏ hàng
            Cart::update($rowId, [
                'qty' => $qty,
                'options' => [
                    'images' => $oldProduct->options->images,
                    'size' => $size,
                    'color' => $color
                ]
            ]);


            // Lấy thông tin mới của giỏ hàng
            $count = Cart::count();
            $total = Cart::total();

            return response()->json([
                'count' => $count,
                'total' => $total
            ]);
        }
        return redirect()->back();
    }


}
