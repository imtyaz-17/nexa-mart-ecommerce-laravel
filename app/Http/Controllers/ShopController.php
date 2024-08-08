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
        $products = Product::where('status', 1)->get();

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
            if($priceMax ===1000)
            {
                $products = $products->whereBetween('price', [$priceMin, 10000000]);
            }
            else
            {
                $products = $products->whereBetween('price', [$priceMin, $priceMax]);
            }
        }
        $sortBy = $request->get('sort-by');

        if (!empty($request->get('sort-by')))
        {
            if ($sortBy== 'latest')
            {
                $products = $products->sortByDesc('created_at');
            }
            elseif ($sortBy == 'price_asc')
            {
                $products = $products->sortBy('price');
            }
            else
            {
                $products = $products->sortByDesc('price');
            }
        }
        else
        {
            $products = $products->sortByDesc('created_at');
        }

        return view('front.shop', compact('categories', 'brands', 'products', 'categorySelected', 'subcategorySelected', 'brandsArray', 'priceMax', 'priceMin', 'sortBy'));
    }
}
