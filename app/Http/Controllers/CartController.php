<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;

use App\Models\Category;

class CartController extends Controller
{
    public function add(Request $request)
    {
        // Retrieve the product information from the request
        $productId = $request->input('product_id');
        $productName = $request->input('product_name');
        $productPrice = $request->input('product_price');
        $productImage = $request->input('product_image');
        $quantity = $request->input('quantity');

        // Retrieve the cart from the session or initialize it
        $cart = Session::get('cart', []);

        // Add the product to the cart
        $cart[$productId] = [
            'id' => $productId,
            'name' => $productName,
            'price' => $productPrice,
            'image' => $productImage,
            'quantity' => $quantity,
        ];

        // Save the cart back to the session
        Session::put('cart', $cart);
        $products = Product::all();
        $categories = Category::all();
        $cart = Session::get('cart', []);
        $totalProducts =  count($cart);
    
        // Redirect to the cart page
        return redirect()->route('cart.index', compact('products', 'categories', 'cart', 'totalProducts'));
    }

    public function index()
    {
        $cartItems = Session::get('cart', []);

        // Calculate subtotal and total
        $subtotal = array_reduce($cartItems, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        $total = $subtotal; // Implement additional logic for totals if needed
        $product = Product::all();
        $categories = Category::all();
        $cart = Session::get('cart', []);
        $totalProducts = count($cart);
        return view('shop.cart', compact('cartItems', 'subtotal', 'total','product', 'categories', 'cart', 'totalProducts'));  
    }

    

    public function edit($id)
{
  

  
   
    $product = Product::findOrFail($id);
    $categories = Category::all();
    $cart = Session::get('cart', []);
    $totalProducts =  count($cart);
    return view('shop.edit', compact('product', 'categories', 'cart', 'totalProducts'));
   
    }


    public function remove(Request $request, $productId)
{
    // Retrieve the cart from the session
    $cart = Session::get('cart', []);

    // Remove the product from the cart if it exists
    if (isset($cart[$productId])) {
        unset($cart[$productId]);
        Session::put('cart', $cart);
    }

    // Optional: If you need to pass all products and categories to the view
    $products = Product::all();
    $categories = Category::all();
    $cart = Session::get('cart', []);
    $totalProducts =  count($cart);
    // Redirect to the cart page with a success message
    return redirect()->route('cart.index')->with('success', 'Item removed successfully.')
    ->with(compact('products', 'categories', 'cart', 'totalProducts'));
}


public function update(Request $request)
{
    // Retrieve the product information from the request
    $productId = $request->input('product_id');
    $quantity = $request->input('quantity', 1); // Default quantity is 1
    $cart = Session::get('cart', []);
    $totalProducts =  count($cart);
    $products = Product::all();
    $categories = Category::all();
    // Retrieve the cart from the session or initialize it
    
    
 
    

    // Check if the product is already in the cart
    if (isset($cart[$productId])) {
        // Update the quantity of the existing product
        $cart[$productId]['quantity'] = $quantity;
    } else {
        // Optionally handle the case where the product is not in the cart
        // For now, we'll just return an error message
        return redirect()->route('cart.index')->with('error', 'Product not found in cart.');
        
    }

    // Save the updated cart back to the session
    Session::put('cart', $cart);

    // Redirect to the cart page with a success message
    return redirect()->route('cart.index')->with('success', 'Cart updated successfully.');
    
}

   

}
