<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Category;

class ShopController extends Controller
{
    public function index(Request $request)
    {

       

 


        $products = Product::all();
        $categories = Category::all(); // Fetch all categories
        $cart = Session::get('cart', []);
        $totalProducts = count($cart);
        // Pass both products and categories to the view
        return view('shop.index', compact('products', 'categories','cart','totalProducts', 'categories' ));
        
    }

    public function single($id)
{
    $product = Product::findOrFail($id);
    $categories = Category::all(); // Fetch all categories
    $cart = Session::get('cart', []);
    $totalProducts = count($cart);

    return view('shop.single', compact('product', 'categories', 'cart', 'totalProducts'));
}

public function showCategoryByName($categoryName)
{
    $cart = Session::get('cart', []);
    $totalProducts = count($cart);
    
    // Fetch the category by name
    $category = Category::where('name', $categoryName)->first();

    // Fetch products that belong to the given category
    $products = Product::where('category_id', $category->id)->get();

    // Fetch all categories for the dropdown
    $categories = Category::all();

    return view('shop.category', compact('products', 'categories', 'cart', 'totalProducts', 'category' ));
}

  
}
