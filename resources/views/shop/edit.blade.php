
@extends('layouts.index')
@section('content')

<div class="bg-light py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-0">
                <a href="{{ url('/') }}">Home</a> <span class="mx-2 mb-0">/</span>
                <a href="{{ route('shop.index') }}">Store</a> <span class="mx-2 mb-0">/</span>
                <strong class="text-black">Edit Cart Item - {{ $product->name }}</strong>
            </div>
        </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-md-5 mr-auto">
                <div class="border text-center">
                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="img-fluid p-5">
                </div>
            </div>
            <div class="col-md-6">
                <h2 class="text-black">{{ $product->name }}</h2>
                <p>{{ $product->description }}</p>
                <p class="price">${{ number_format($product->price, 2) }}</p>

                <!-- Edit Cart Item Form -->
                <form action="{{ route('cart.update') }}" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="product_name" value="{{ $product->name }}">
                    <input type="hidden" name="product_price" value="{{ $product->price }}">
                    <input type="hidden" name="product_image" value="{{ $product->image_path }}">
                    <div class="mb-5">
                        <div class="input-group mb-3" style="max-width: 120px;">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                            </div>
                            <!-- Pre-fill the quantity from the cart item -->
                            <input type="number" class="form-control text-center" name="quantity" value="1" min="1">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                            </div>
                        </div>
                    </div>
                    <p><button type="submit" class="buy-now btn btn-sm height-auto px-4 py-3 btn-primary">Update Cart Item</button></p>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
