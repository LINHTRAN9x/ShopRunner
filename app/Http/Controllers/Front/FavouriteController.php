<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Favourite;
use App\Services\Product\ProductServiceInterface;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    private $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }
    public function index()
    {
        $locale = Session()->get('locale');
        $userId = Auth::id();
        $favourites = Favourite::where('user_id', $userId)->orderByDesc('id')->get();
        $favouriteCount = Favourite::where('user_id', $userId)->count();

        return view('front.page.favourite', compact('locale', 'favourites', 'favouriteCount'));
    }

    public function addFav(Request $request)
    {
        if ($request->ajax()) {
            $product = $this->productService->find($request->productId);
            $qty = $request->input('qty', 1);
            $size = $request->input('size');
            $color = $request->input('color');

            $userId = auth()->id();

            $favouriteExist = Favourite::where('user_id', $userId)
                ->where('product_id', $product->id)
                ->exists();

            if ($favouriteExist) {
                return response()->json([
                    'count' => Favourite::where('user_id', $userId)->count(),
                    'message' => 'Product is already in favourites!'
                ]);
            }

            Favourite::create([
                'user_id' => $userId,
                'product_id' => $product->id,
            ]);

            return response()->json([
                'count' => Favourite::where('user_id', $userId)->count(),
                'message' => 'Added to favourites successfully!'
            ]);
        }

        return back();
    }


    public function removeFromFavourites($productId)
    {
        if (Auth::check()) {
            $userId = Auth::id();
            $favourite = Favourite::where('user_id', $userId)->where('product_id', $productId)->first();

            if ($favourite) {
                $favourite->delete();
                return redirect()->back()->with('success', 'Product removed from favourites successfully!');
            } else {
                return redirect()->back()->with('error', 'Product not found in favourites!');
            }
        } else {
            return redirect()->back()->with('error', 'Please login to remove product from favourites!');
        }
    }

    public function clearFav()
    {
        //session()->forget('favourites');
        $userId = auth()->id();

        Favourite::where('user_id', $userId)->delete();

        return redirect()->back()->with('success', 'Favourite cleared successfully');
    }

}
