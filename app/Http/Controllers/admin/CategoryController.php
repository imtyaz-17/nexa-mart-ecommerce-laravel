<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CategoryController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = Category::query();
        if ($request->has('keyword') && $request->keyword != '') {
            $keyword = $request->keyword;
            $query->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('slug', 'LIKE', "%{$keyword}%");
        }

        $categories = $query->latest()->paginate(10);
        return view('admin.category.list', compact('categories'));
    }
    public function create()
    {
        return view('admin.category.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|unique:categories|string|max:255',
            'status' => 'required|boolean',
            'image' => 'nullable|string',
        ]);

        $category = new Category();
        $category->name = $validated['name'];
        $category->slug = $validated['slug'];
        $category->status = $validated['status'];

        if (!empty($request->image)){
            $category->image = $request->image;

            //  Generate Image Thumbnail
            $imagePath = public_path('uploads/categoryImage/' . $category->image);
            // Check if the 'thumb' directory exists
            $thumbDirectory = public_path('uploads/categoryImage/thumb');
            if (!File::exists($thumbDirectory)) {
                // Create the 'thumb' directory if it doesn't exist
                File::makeDirectory($thumbDirectory, 0755, true);
            }
            $thumbnailPath = public_path('uploads/categoryImage/thumb/' . $category->image);

            $manager = new ImageManager(new Driver());
            $thumbnail  =  $manager->read($imagePath);
            $thumbnail->resize(400, 400);
            $thumbnail->save($thumbnailPath);
        }
        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }
    public function show(Category $category)
    {

    }
    public function edit($categoryId)
    {
        $category = Category::find($categoryId);
        if (empty($category)) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Category not found.');
        }
        return view('admin.category.edit', compact('category'));
    }
    public function update(Request $request, $categoryId)
    {
        $category = Category::find($categoryId);
        if (empty($category)) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Category not found.');
        }
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|unique:categories,slug,'.$category->id.'|string|max:255',
            'status' => 'required|boolean',
            'image' => 'nullable|string',
        ]);

        $category->name = $validated['name'];
        $category->slug = $validated['slug'];
        $category->status = $validated['status'];
        $oldImage = $category->image;

        if (!empty($request->image)){
            $category->image = $request->image;

            //  Generate Image Thumbnail
            $imagePath = public_path('uploads/categoryImage/' . $category->image);
            // Check if the 'thumb' directory exists
            $thumbDirectory = public_path('uploads/categoryImage/thumb');
            if (!File::exists($thumbDirectory)) {
                // Create the 'thumb' directory if it doesn't exist
                File::makeDirectory($thumbDirectory, 0755, true);
            }
            $thumbnailPath = public_path('uploads/categoryImage/thumb/' .$category->image);

            $manager = new ImageManager(new Driver());
            $thumbnail  =  $manager->read($imagePath);
            $thumbnail->resize(400, 300);
            $thumbnail->save($thumbnailPath);

            //   Delete Old Image
            File::delete(public_path('/uploads/categoryImage/' . $oldImage));
            File::delete(public_path('/uploads/categoryImage/thumb/' . $oldImage));
        }
        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }
    public function destroy($categoryId)
    {
        $category = Category::find($categoryId);
        if (empty($category)) {
            return redirect()->route('admin.categories.index')->with('error', 'Category not found.');
        }
        //   Delete Old Image
        File::delete(public_path('/uploads/categoryImage/' . $category->image));
        File::delete(public_path('/uploads/categoryImage/thumb/' . $category->image));
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
