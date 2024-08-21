<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Show the form to create a new product
    public function create()
    {
        // Retrieve all categories for the dropdown
        $categories = Category::all();
        return view('admin.AddProduct', compact('categories'));
    }
    public function store(Request $request)
{
    // Validate the request data
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'category_id' => 'required|exists:categories,id',
        'quantity' => 'required|integer',
        'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Create a new product instance
    $product = new Product();
    $product->name = $request->name;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->category_id = $request->category_id;
    $product->quantity = $request->quantity;

    // Handle image upload
    if ($request->hasFile('image_path')) {
        $image = $request->file('image_path');
        $imagePath = $image->store('images', 'public'); // Store the image and get its path
        $product->image_path = $imagePath; // Assign the image path to the product
    }

    // Save the product to the database
    $product->save();

    // Redirect with success message
    return redirect()->route('products.index')->with('success', 'Product added successfully!');
}


   

    // Show all products (optional, you can add this method if you want to display all products)
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.AllProducts', compact('products'));
    }

    // Show the form to edit a specific product
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.EditProduct', compact('product', 'categories'));
    }

    // Update a specific product in storage
    public function update(Request $request, Product $product)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer|min:0',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the image upload
        if ($request->hasFile('image_path')) {
            // Delete old image if exists
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }
            $imagePath = $request->file('image_path')->store('product_images', 'public');
        } else {
            $imagePath = $product->image_path;
        }

        // Update the product
        $product->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'category_id' => $request->input('category_id'),
            'quantity' => $request->input('quantity'),
            'image_path' => $imagePath,
        ]);

        // Redirect with success message
        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    // Remove a specific product from storage
    public function destroy(Product $product)
    {
        // Delete the image if exists
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }

        // Delete the product
        $product->delete();

        // Redirect with success message
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
