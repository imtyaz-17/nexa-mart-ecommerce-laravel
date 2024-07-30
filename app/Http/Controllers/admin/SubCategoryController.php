<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $subcategories = SubCategory::select('sub_categories.*', 'categories.name as category_name')
            ->latest('id')
            ->leftJoin('categories', 'sub_categories.category_id', '=', 'categories.id');

        if (!empty($request->keyword)) {
            $keyword = $request->keyword;
            $subcategories = $subcategories->where('sub_categories.name', 'LIKE', "%{$keyword}%")
                ->orWhere('sub_categories.slug', 'LIKE', "%{$keyword}%");
        }

        $subcategories = $subcategories->paginate(10);

        return view('admin.sub_category.list', compact('subcategories'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('admin.sub_category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|unique:sub_categories|string|max:255',
            'status' => 'required|boolean',
            'category'=>'required|exists:categories,id',
        ]);

        $subcategory = new SubCategory();
        $subcategory->name = $validated['name'];
        $subcategory->slug = $validated['slug'];
        $subcategory->status = $validated['status'];
        $subcategory->category_id = $validated['category'];

        $subcategory->save();

        return redirect()->route('admin.subcategories.index')->with('success', 'Sub Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($subCategoryId)
    {
        $subCategory = SubCategory::find($subCategoryId);
        if (empty($subCategory)) {
            return redirect()->route('admin.subcategories.index')
                ->with('error', 'Sub Category not found.');
        }
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('admin.sub_category.edit', compact('categories','subCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $subCategoryId)
    {
        $subcategory = SubCategory::find($subCategoryId);
        if (is_null($subcategory)) {
            return redirect()->route('admin.subcategories.index')
                ->with('error', 'Sub Category not found.');
        }
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|unique:sub_categories,slug,'.$subcategory->id.'|string|max:255',
            'status' => 'required|boolean',
            'category'=>'required|exists:categories,id',
        ]);
        $subcategory->name = $validated['name'];
        $subcategory->slug = $validated['slug'];
        $subcategory->status = $validated['status'];
        $subcategory->category_id = $validated['category'];

        $subcategory->save();

        return redirect()->route('admin.subcategories.index')->with('success', 'Sub Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($subCategoryId)
    {
        $subcategory = SubCategory::find($subCategoryId);
        if (is_null($subcategory)) {
            return redirect()->route('admin.subcategories.index')
                ->with('error', 'Sub Category not found.');
        }
        $subcategory->delete();
        return redirect()->route('admin.subcategories.index')->with('success', 'Sub Category deleted successfully');
    }
}
