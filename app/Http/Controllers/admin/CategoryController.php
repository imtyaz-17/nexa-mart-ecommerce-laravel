<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index()
    {

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
        ]);

        $category = new Category();
        $category->name = $validated['name'];
        $category->slug = $validated['slug'];
        $category->status = $validated['status'];

        $category->save();

        return redirect()->route('admin.categories.create')->with('success', 'Category created successfully.');
    }
    public function show(Category $category)
    {

    }
    public function edit(Category $category)
    {

    }
    public function update(Request $request, Category $category)
    {

    }
    public function destroy(Category $category)
    {

    }
}
