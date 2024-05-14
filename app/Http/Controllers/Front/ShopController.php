<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Favourite;
use App\Models\Product;
use App\Services\Brand\BrandServiceInterface;
use App\Services\Product\ProductServiceInterface;
use App\Services\ProductCategory\ProductCategoryServiceInterface;
use App\Services\ProductComment\ProductCommentServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $locale = Session()->get('locale');
        $favouriteCount = 0;
        if (Auth::check()) {
            $userId = Auth::id();
            $favouriteCount = Favourite::where('user_id', $userId)->count();
        }



        return view('front.shop.product-details',compact('product','relatedProducts','productRating','locale','favouriteCount'));
    }

    public function postComment(Request $request)
    {
        $this->productCommentService->create($request->all());
        return redirect()->back();
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
        $locale = Session()->get('locale');
        $favouriteCount = 0;
        if (Auth::check()) {
            $userId = Auth::id();
            $favouriteCount = Favourite::where('user_id', $userId)->count();
        }

        return view('front.shop.index',compact("products","categories","brands",'productRating','locale','favouriteCount'));
    }

    public function quickView(Request $request)
    {
        if ($request->ajax()){
            $productId = $this->productService->find($request->productId);
            $product = Product::findOrFail($productId);
            return response()->json($product);

        };
        return back();
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

        // Lấy tham số lọc giá từ yêu cầu
        $priceMin = $request->input('price_min');
        $priceMax = $request->input('price_max');


        $products = $this->productService->getProductsByCategory($categoryName,$request, $priceMin, $priceMax);
        return view('front.shop.index',compact("products","categories","brands","productRating",'locale','favouriteCount'));
    }



}
