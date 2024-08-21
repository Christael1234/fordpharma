<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Category;

class IndexController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        $totalProducts = count($cart);
        $categories = Category::all();
        return view('frontend.index', compact('categories', 'cart', 'totalProducts'));
    }

    




}
