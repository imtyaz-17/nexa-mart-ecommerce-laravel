<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name', 'ASC')
            ->where('status', 1)
            ->with('subcategories')
            ->get();
        $brands = Brand::orderBy('name', 'ASC')->where('status', 1)->get();
        $products = Product::orderBy('id', 'DESC')->where('status', 1)->get();
        return view('front.shop' , compact('categories','brands','products'));
    }
}
