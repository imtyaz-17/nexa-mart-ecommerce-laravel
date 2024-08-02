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
    public function index(Request $request)
    {
        $products = Product::latest('id')->with('productImages');
        if (!empty($request->keyword)) {
            $keyword = $request->keyword;
            $products = $products->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('slug', 'LIKE', "%{$keyword}%");
        }
        $products = $products->paginate(10);
        return view('admin.products.list', compact('products'));
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
                $thumbnail->resize(300, 300);
                $thumbnail->save($thumbnailPath);
            }
        }
        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }
    public function show(Product $product)
    {

    }
    public function edit($productId)
    {
        $product=Product::find($productId);
        if (empty($product)) {
            return redirect()->route('admin.products.index')
                ->with('error', 'Product not found.');
        }
        $categories = Category::orderBy('name', 'ASC')->get();
        $subcategories = SubCategory::where('category_id', $product->category_id)->get();
        $brands = Brand::orderBy('name', 'ASC')->get();

        $productImages = ProductImage::where('product_id', $product->id)->get();
        return view('admin.products.edit', compact('product', 'categories', 'subcategories', 'brands', 'productImages'));
    }
    public function update(Request $request, $productId)
    {
        $product=Product::find($productId);
        if (empty($product)) {
            return redirect()->route('admin.products.index')
                ->with('error', 'Product not found.');
        }
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,'.$product->id.',id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|min:0|gt:price',
            'category' => 'required|exists:categories,id',
            'sub_category' => 'nullable|exists:sub_categories,id',
            'sku'=>'required|string|max:255|unique:products,sku,'.$product->id.',id',
            'brand' => 'nullable|exists:brands,id',
            'is_featured' => 'required|in:yes,no',
            'barcode' => 'nullable|string|max:255|unique:products,barcode,'.$product->id.',id',
            'track_qty' => 'required|in:yes,no',
            'status' => 'required|boolean',
            'qty' => $request->track_qty === 'yes' ? 'required|integer|min:0' : 'nullable|integer|min:0',
            'images' => 'nullable|string',
        ]);

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
                $thumbnail->resize(300, 300);
                $thumbnail->save($thumbnailPath);
            }
        }
        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');

    }
    public function destroy($productId)
    {
        $product = Product::find($productId);
        if (empty($product)) {
            return redirect()->route('admin.products.index')->with('error', 'Product not found.');
        }
        $productImages = ProductImage::where('product_id', $productId)->get();
        if (!empty($productImages)) {
            foreach ($productImages as $productImage) {
                File::delete(public_path('/uploads/productImage/' . $productImage->image));
                File::delete(public_path('/uploads/productImage/thumb/' . $productImage->image));
            }
            ProductImage::where('product_id', $productId)->delete();
        }
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
