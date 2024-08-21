@extends('layouts.admin')
@section('content')

<!-- Include SweetAlert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<section class="section">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Add New Product</h1>

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

                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="productName" class="form-label fw-bold">Product Name</label>
                        <input type="text" class="form-control" id="productName" name="name" placeholder="Enter product name" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="productDescription" class="form-label fw-bold">Product Description</label>
                        <textarea class="form-control" id="productDescription" name="description" placeholder="Enter product description" rows="4"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="productPrice" class="form-label fw-bold">Product Price</label>
                        <input type="number" step="0.01" class="form-control" id="productPrice" name="price" placeholder="Enter product price" required>
                    </div>

                    <div class="mb-3">
                        <label for="productCategory" class="form-label fw-bold">Category</label>
                        <select class="form-control" id="productCategory" name="category_id" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="productQuantity" class="form-label fw-bold">Quantity</label>
                        <input type="number" class="form-control" id="productQuantity" name="quantity" placeholder="Enter product quantity" required>
                    </div>

                    <div class="mb-3">
                        <label for="productImage" class="form-label fw-bold">Product Image</label>
                        <input type="file" class="form-control" id="productImage" name="image_path" accept="image/*" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Product</button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

