@extends('layouts.admin')
@section('content')

<!-- Include SweetAlert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<section class="section">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Edit Product</h1>

                <!-- Success Alert using SweetAlert -->
                @if(session('success'))
                <script>
                    Swal.fire({
                        title: 'Success!',
                        text: '{{ session("success") }}',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                </script>
                @endif

                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="productName" class="form-label fw-bold">Product Name</label>
                        <input type="text" class="form-control" id="productName" name="name" value="{{ $product->name }}" placeholder="Enter product name" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="productDescription" class="form-label fw-bold">Product Description</label>
                        <textarea class="form-control" id="productDescription" name="description" placeholder="Enter product description" rows="4">{{ $product->description }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="productPrice" class="form-label fw-bold">Product Price</label>
                        <input type="number" step="0.01" class="form-control" id="productPrice" name="price" value="{{ $product->price }}" placeholder="Enter product price" required>
                    </div>

                    <div class="mb-3">
                        <label for="productCategory" class="form-label fw-bold">Category</label>
                        <select class="form-control" id="productCategory" name="category_id" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if($category->id == $product->category_id) selected @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="productQuantity" class="form-label fw-bold">Quantity</label>
                        <input type="number" class="form-control" id="productQuantity" name="quantity" value="{{ $product->quantity }}" placeholder="Enter product quantity" required>
                    </div>

                    <div class="mb-3">
                        <label for="productImage" class="form-label fw-bold">Product Image</label>
                        <input type="file" class="form-control" id="productImage" name="image_path" accept="image/*">
                        <!-- Display the current image -->
                        @if($product->image_path)
                            <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="img-fluid mt-2" width="150">
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary">Update Product</button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
