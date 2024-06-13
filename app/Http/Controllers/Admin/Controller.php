<?php

namespace App\Http\Controllers\Admin;

use App\Models\Favourite;
use App\Services\Product\ProductServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    private $productService;
    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    public function show($id)
    {
        $locale = Session()->get('locale');
        $product = $this->productService->find($id);
        return view('front.shop.product-details',compact('product','locale'));
    }
    public function blog()
    {
        $locale = Session()->get('locale');
        $favouriteCount = 0;
        if (Auth::check()) {
            $userId = Auth::id();
            $favouriteCount = Favourite::where('user_id', $userId)->count();
        }
        return view('front.page.blog',compact('locale','favouriteCount'));
    }
    public function contacts()
    {
        $locale = Session()->get('locale');
        $favouriteCount = 0;
        if (Auth::check()) {
            $userId = Auth::id();
            $favouriteCount = Favourite::where('user_id', $userId)->count();
        }
        return view('front.page.contacts',compact('locale','favouriteCount'));
    }
}
