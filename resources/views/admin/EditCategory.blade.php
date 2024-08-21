@extends('layouts.admin')
@section('content')

<!-- Include SweetAlert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<section class="section">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Edit Category</h1>

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

                <form action="{{ route('categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- This is important for the update method -->
                    
                    <div class="mb-3">
                        <label for="categoryName" class="form-label fw-bold">Category Name</label>
                        <input type="text" class="form-control" id="categoryName" name="name" value="{{ old('name', $category->name) }}" placeholder="Enter category name" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Update Category</button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
