<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('/index', [App\Http\Controllers\IndexController::class, 'index'])->name('frontend.index');


Route::middleware(['auth'])->group(function () {
    

    Route::get('/admin/index', [AdminController::class, 'index'])->name('admin.index');

    
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    
// Route to display the form to edit an existing category
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');

// Route to update an existing category
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');

// Optional: Route to display all categories (index page)
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');




// Display all products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Show the form to create a new product
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

// Store a newly created product
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

// Show the form to edit a specific product
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');

// Update a specific product
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');

// Remove a specific product
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

});




Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{id}', [ShopController::class, 'single'])->name('shop.single');
Route::get('/shop/category/{category}', [ShopController::class, 'showCategoryByName'])->name('shop.category.name');


Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');



Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/edit/{id}', [CartController::class, 'edit'])->name('cart.edit');




Route::get('/contact', [ContactController::class, 'show'])->name('contact.showForm');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');






