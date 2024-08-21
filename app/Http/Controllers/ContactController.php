<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use App\Models\Category;

class ContactController extends Controller
{
    public function show()
    {
        $product = Product::all();
        $categories = Category::all();
        $cart = Session::get('cart', []);
        $totalProducts =  count($cart);
        return view('contact.index'  ,compact('cart', 'product', 'categories', 'totalProducts'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Create a new contact record
        Contact::create([
            'fname' => $request->input('fname'),
            'lname' => $request->input('lname'),
            'email' => $request->input('email'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
        ]);

        // Redirect with a success message
        return redirect()->route('contact.showForm')->with('success', 'Your message has been sent successfully.');
    }
}
