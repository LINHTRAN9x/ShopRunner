<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Favourite;
use App\Services\Product\ProductServiceInterface;
use App\Services\ProductComment\ProductCommentServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private $productService;
    private $productCommentService;

    public function __construct(ProductServiceInterface $productService,
                                ProductCommentServiceInterface $productCommentService)
    {
        $this->productService = $productService;
        $this->productCommentService = $productCommentService;
    }

    public function home()
    {
        $featuredProducts = $this->productService->getProductFeatured();

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


        return view('front.index',compact('featuredProducts','productRating','locale','favourites','favouriteCount'));
    }
}
