@extends('layouts.index')
@section('content')

<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="mb-3 h6 text-uppercase text-black d-block">{{ $category->name }}</h3>
            </div>
        </div>

        <div class="row">
            @foreach($products as $product)
                <div class="col-sm-6 col-lg-4 text-center item mb-4">
                    @if($product->is_on_sale)
                        <span class="tag">Sale</span>
                    @endif
                    <a href="{{ route('shop.single', $product->id) }}">
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}">
                    </a>
                    <h3 class="text-dark"><a href="{{ route('shop.single', $product->id) }}">{{ $product->name }}</a></h3>
                    <p class="price">${{ number_format($product->price, 2) }}</p>
                </div>
            @endforeach
        </div>

        <div class="row mt-5">
            <div class="col-md-12 text-center">
                <div class="site-block-27">
                    <ul>
                        <!-- Pagination links (if needed) -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
