


@extends('layouts.index')
@section('content')

<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter by Price</h3>
                <div id="slider-range" class="border-primary"></div>
                <input type="text" name="text" id="amount" class="form-control border-0 pl-0 bg-white" disabled="" />
            </div>
            <div class="col-lg-6">
                <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter by Reference</h3>
                <button type="button" class="btn btn-secondary btn-md dropdown-toggle px-4" id="dropdownMenuReference"
                    data-toggle="dropdown">Reference</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                    <a class="dropdown-item" href="#">Relevance</a>
                    <a class="dropdown-item" href="#">Name, A to Z</a>
                    <a class="dropdown-item" href="#">Name, Z to A</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Price, low to high</a>
                    <a class="dropdown-item" href="#">Price, high to low</a>
                </div>
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
                    <p class="price">
                        
                    ₦{{ number_format($product->price, 2) }}
                    
                    </p>
                </div>
            @endforeach
        </div>

        <div class="row mt-5">
            <div class="col-md-12 text-center">
                <div class="site-block-27">
                    <ul>
                        <!-- Pagination links -->
                      
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
