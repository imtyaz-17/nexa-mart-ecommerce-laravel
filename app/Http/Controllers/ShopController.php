<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request, $categorySlug = null, $subcategorySlug = null)
    {
        $categorySelected = '';
        $subcategorySelected = '';
        $brandsArray = [];

        $categories = Category::orderBy('name', 'ASC')
            ->where('status', 1)
            ->with('subcategories')
            ->get();
        $brands = Brand::orderBy('name', 'ASC')->where('status', 1)->get();
        $products = Product::where('status', 1);


        //Search box
        if (!empty($request->get('search'))) {
            $products = $products->where('title', 'like', '%' . $request->get('search') . '%');
        }

        //Apply Filters
        if (!empty($categorySlug)) {
            $category = Category::where('slug', $categorySlug)->first();
            $products = $products->where('category_id', $category->id);
            $categorySelected = $category->id;
        }
        if (!empty($subcategorySlug)) {
            $subcategory = SubCategory::where('slug', $subcategorySlug)->first();
            $products = $products->where('sub_category_id', $subcategory->id);
            $subcategorySelected = $subcategory->id;
        }
        if (!empty($request->get('brands'))) {
            $brandsArray = explode(',', $request->get('brands'));
            $products = $products->whereIn('brand_id', $brandsArray);
        }
        $priceMin = 0;
        $priceMax = 1000;
        if (!empty($request->get('price_max')) && !empty($request->get('price_min'))) {
            $priceMin = intval($request->get('price_min'));
            $priceMax = intval($request->get('price_max'));
            if ($priceMax === 1000) {
                $products = $products->whereBetween('price', [$priceMin, 10000000]);
            } else {
                $products = $products->whereBetween('price', [$priceMin, $priceMax]);
            }
        }
        $sortBy = $request->get('sort-by');

        if (!empty($request->get('sort-by'))) {
            if ($sortBy == 'latest') {
                $products = $products->orderBy('created_at', 'desc');
            } elseif ($sortBy == 'price_asc') {
                $products = $products->orderBy('price', 'asc');
            } else {
                $products = $products->orderBy('price', 'desc');
            }
        } else {
            $products = $products->orderBy('created_at', 'desc');
        }

        $products = $products->paginate(6);
        return view('front.shop', compact('categories', 'brands', 'products', 'categorySelected', 'subcategorySelected', 'brandsArray', 'priceMax', 'priceMin', 'sortBy'));
    }

    public function product($slug)
    {
        $product = Product::where('slug', $slug)
            ->withCount('productRatings')
            ->withSum('productRatings', 'rating')
            ->with(['productImages', 'productRatings.user'])->first();
//        dd($product);
        $avgRating = 0.0;
        if ($product->product_ratings_count > 0) {
            $avgRating = number_format(($product->product_ratings_sum_rating / $product->product_ratings_count), 1);
        }
        if ($product != null) {
            $relatedProducts = Product::where('sub_category_id', $product->sub_category_id)
                ->where('status', 1)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            abort(404);
        }
        return view('front.product', compact('product', 'avgRating', 'relatedProducts'));
    }
}
