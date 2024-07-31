<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class BrandController extends Controller
{
    //
    public function index(Request $request)
    {
        $brands = Brand::latest('id');
        if (!empty($request->keyword)) {
            $keyword = $request->keyword;
            $brands = $brands->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('slug', 'LIKE', "%{$keyword}%");
        }
        $brands = $brands->paginate(10);
        return view('admin.brands.list', compact('brands'));
    }
    public function create()
    {
        return view('admin.brands.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|unique:brands|string|max:255',
            'status' => 'required|boolean',
            'image' => 'nullable|string',
        ]);

        $brand = new Brand();
        $brand->name = $validated['name'];
        $brand->slug = $validated['slug'];
        $brand->status = $validated['status'];

        if (!empty($request->image)){
            $brand->image = $request->image;

            //  Generate Image Thumbnail
            $imagePath = public_path('uploads/brandImage/' . $brand->image);
            // Check if the 'thumb' directory exists
            $thumbDirectory = public_path('uploads/brandImage/thumb');
            if (!File::exists($thumbDirectory)) {
                // Create the 'thumb' directory if it doesn't exist
                File::makeDirectory($thumbDirectory, 0755, true);
            }
            $thumbnailPath = public_path('uploads/brandImage/thumb/' . $brand->image);

            $manager = new ImageManager(new Driver());
            $thumbnail  =  $manager->read($imagePath);
            $thumbnail->resize(300, 300);
            $thumbnail->save($thumbnailPath);
        }
        $brand->save();

        return redirect()->route('admin.brands.index')->with('success', 'Brand has been created');
    }
    public function show(Brand $brand)
    {

    }
    public function edit($brandId)
    {
        $brand = Brand::find($brandId);
        if (empty($brand)) {
            return redirect()->route('admin.brands.index')
                ->with('error', 'Brand not found.');
        }
        return view('admin.brands.edit', compact('brand'));
    }
    public function update(Request $request, $brandId)
    {
        $brand = Brand::find($brandId);
        if (empty($brand)) {
            return redirect()->route('admin.brands.index')
                ->with('error', 'Brand not found.');
        }
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|unique:brands,slug,'.$brand->id.'|string|max:255',
            'status' => 'required|boolean',
            'image' => 'nullable|string',
        ]);

        $brand->name = $validated['name'];
        $brand->slug = $validated['slug'];
        $brand->status = $validated['status'];
        $oldImage = $brand->image;

        if (!empty($request->image)){
            $brand->image = $request->image;

            //  Generate Image Thumbnail
            $imagePath = public_path('uploads/brandImage/' . $brand->image);
            // Check if the 'thumb' directory exists
            $thumbDirectory = public_path('uploads/brandImage/thumb');
            if (!File::exists($thumbDirectory)) {
                // Create the 'thumb' directory if it doesn't exist
                File::makeDirectory($thumbDirectory, 0755, true);
            }
            $thumbnailPath = public_path('uploads/brandImage/thumb/' . $brand->image);

            $manager = new ImageManager(new Driver());
            $thumbnail  =  $manager->read($imagePath);
            $thumbnail->resize(300, 300);
            $thumbnail->save($thumbnailPath);

            //   Delete Old Image
            File::delete(public_path('/uploads/brandImage/' . $oldImage));
            File::delete(public_path('/uploads/brandImage/thumb/' . $oldImage));
        }
        $brand->save();
        return redirect()->route('admin.brands.index')->with('success', 'Brand has been updated');
    }
    public function destroy($brandId)
    {
        $brand = Brand::find($brandId);
        if (empty($brand)) {
            return redirect()->route('admin.brands.index')
                ->with('error', 'Brand not found.');
        }

        $brand->delete();
        //   Delete Old Image
        File::delete(public_path('/uploads/brandImage/' . $brand->image));
        File::delete(public_path('/uploads/brandImage/thumb/' . $brand->image));

        return redirect()->route('admin.brands.index')->with('success', 'Brand has been deleted');
    }
}
