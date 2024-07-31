<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class BrandController extends Controller
{
    //
    public function index()
    {

    }
    public function create()
    {
        return view('admin.brands.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|unique:categories|string|max:255',
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
            $imagePath = public_path('uploads/categoryImage/' . $brand->image);
            $thumbnailPath = public_path('uploads/categoryImage/thumb/' . $brand->image);

            $manager = new ImageManager(new Driver());
            $thumbnail  =  $manager->read($imagePath);
            $thumbnail->cover(300, 300);
            $thumbnail->save($thumbnailPath);
        }
        $brand->save();

        return redirect()->route('admin.brands.index')->with('success', 'Brand has been created');
    }
    public function show(Brand $brand)
    {

    }
    public function edit(Brand $brand)
    {

    }
    public function update(Request $request, Brand $brand)
    {

    }
    public function destroy(Brand $brand)
    {

    }
}
