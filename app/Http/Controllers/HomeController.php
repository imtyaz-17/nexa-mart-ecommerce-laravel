<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
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
}
