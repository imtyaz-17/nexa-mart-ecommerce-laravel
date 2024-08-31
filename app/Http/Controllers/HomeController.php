<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $categories = Category::where('status', 1)
            ->with('subcategories')
            ->orderBy('name', 'ASC')->get();
        $featureProducts = Product::where('is_featured', true)->orderBy('id', 'DESC')->where('status', 1)->get();
        $latestProducts = Product::orderBy('id', 'DESC')->where('status', 1)->take(8)->get();

        return view('front.home', compact('categories', 'featureProducts', 'latestProducts'));
    }

    public function addToWishlist(Request $request)
    {
        if (!auth()->check()) {
            session(['url.intended' => url()->previous()]);
            return response()->json([
                'success' => false,
                'message' => 'You need to login first'
            ]);
        }
        $product = Product::where('id', $request->id)->first();
        if ($product == null) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ]);
        }
        $wishlist = Wishlist::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'product_id' => $request->id
            ]
        );
        return response()->json([
            'success' => true,
            'message' => '<div class="alert alert-success"><strong>"' . $product->title . '"</strong> added to wishlist</div'
        ]);
    }
}
