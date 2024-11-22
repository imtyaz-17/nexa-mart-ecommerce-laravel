<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductRating;
use Illuminate\Http\Request;

class ProductRatingController extends Controller
{
    public function index()
    {

    }

    public function store(Request $request, $productId)
    {
        $validated = $request->validate([
            'rating' => 'required|numeric|min:0|max:5',
            'comment' => 'nullable|string|min:3'
        ]);
        $productSlug = Product::where('id', $productId)->value('slug');
        $count = ProductRating::where('product_id', $productId)
            ->where('user_id', auth()->id())
            ->count();
        if ($count > 0) {
            return redirect()->back()->with('error', 'You already review this product.');
        }
        $productRating = ProductRating::create([
            'product_id' => $productId,
            'user_id' => auth()->id(),
            'comment' => $request->comment,
            'rating' => $request->rating,
        ]);
//        return redirect()->route('product', ['slug' => $productSlug])->with('successRating', 'Your review has been submitted and is pending approval.');
        return redirect()->back()->with('success', 'Your review has been submitted and is pending approval.');
    }
}
