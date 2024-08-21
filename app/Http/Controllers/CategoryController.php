<?php

namespace App\Http\Controllers;




namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
{
    $categories = Category::all();
    return view('admin.AllCategories', compact('categories'));
}
    public function create()
    {
        return view('admin.CreateCategory');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('categories.create')->with('success', 'Category added successfully.');
    }
    public function edit($id)
    {
        // Find the category by ID
        $category = Category::findOrFail($id);

        // Return the edit view with the category data
        return view('admin.EditCategory', compact('category'));
    }

    public function update(Request $request, Category $category)
{
    $request->validate([
        'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
    ]);

    $category->update([
        'name' => $request->name,
    ]);

    return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
}

public function destroy($id)
{
    // Find the category by its ID
    $category = Category::findOrFail($id);
    
    // Delete the category
    $category->delete();

    // Redirect back with a success message
    return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
}
}
