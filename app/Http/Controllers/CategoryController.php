<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('category.index', ['categories' => $categories]);
    }

    public function add()
    {
        return view('category.add');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories',
        ]);

        $category = Category::create($request->all());

        return redirect('category')->with('status', 'Category Added Successfully');
    }

    public function edit($slug)
    {
        $category = Category::where('slug', $slug)->first();
        return view('category.edit', ['category' => $category]);
    }

    public function update(Request $request, $slug)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories',
        ]);

        $category = Category::where('slug', $slug)->first();
        $category->slug = null;
        $category->update($request->all());
        return redirect('category')->with('status', 'Category Updated Successfully');
    }

    public function delete($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $category->delete();
        return redirect('category')->with('status', 'Category Deleted Successfully');
    }

    public function deleted()
    {
        $deleted = Category::onlyTrashed()->get();

        return view('category.deleted', ['deleted' => $deleted]);
    }

    public function restore($slug)
    {
        $category = Category::withTrashed()->where('slug', $slug)->first();
        $category->restore();
        return redirect('category')->with('status', 'Category Restored Successfully');
    }
}
