<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ProductController extends Controller
{
    public function index()
    {

    }
    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        $brands = Brand::orderBy('name', 'ASC')->get();

        return view('admin.products.create', compact('categories', 'brands'));
    }
    public function productSubcategories($categoryId)
    {
        $subcategories = Category::find($categoryId)->subcategories;
        return response()->json($subcategories);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|min:0|gt:price',
            'category' => 'required|exists:categories,id',
            'sub_category' => 'nullable|exists:sub_categories,id',
            'sku'=>'required|string|max:255|unique:products,sku',
            'brand' => 'nullable|exists:brands,id',
            'is_featured' => 'required|in:yes,no',
            'barcode' => 'nullable|string|max:255|unique:products,barcode',
            'track_qty' => 'required|in:yes,no',
            'status' => 'required|boolean',
            'qty' => $request->track_qty === 'yes' ? 'required|integer|min:0' : 'nullable|integer|min:0',
            'images' => 'nullable|string',
        ]);

        $product = new Product();
        $product->title =$validated['title'];
        $product->slug=$validated['slug'];
        $product->description=$validated['description'];
        $product->price=$validated['price'];
        $product->compare_price=$validated['compare_price'];
        $product->sku=$validated['sku'];
        $product->barcode=$validated['barcode'];
        $product->track_qty=$validated['track_qty'];
        $product->qty=$validated['qty'];
        $product->status=$validated['status'];
        $product->category_id=$validated['category'];
        $product->sub_category_id=$validated['sub_category'];
        $product->brand_id=$validated['brand'];
        $product->is_featured=$validated['is_featured'];
        $product->save();

        if (!empty($validated['images'])) {
            $imageNames = json_decode($validated['images'], true);
//            dd($product->id);
            foreach ($imageNames as $imageName) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $imageName,
                ]);
                //  Generate Image Thumbnail
                $imagePath = public_path('uploads/productImage/' . $imageName);
                // Check if the 'thumb' directory exists
                $thumbDirectory = public_path('uploads/productImage/thumb');
                if (!File::exists($thumbDirectory)) {
                    // Create the 'thumb' directory if it doesn't exist
                    File::makeDirectory($thumbDirectory, 0755, true);
                }
                $thumbnailPath = public_path('uploads/productImage/thumb/' . $imageName);

                $manager = new ImageManager(new Driver());
                $thumbnail = $manager->read($imagePath);
                $thumbnail->resize(400, 400);
                $thumbnail->save($thumbnailPath);
            }
        }
        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }
    public function show(Product $product)
    {

    }
    public function edit(Product $product)
    {

    }
    public function update(Request $request, Product $product)
    {

    }
    public function destroy(Product $product)
    {

    }
}
