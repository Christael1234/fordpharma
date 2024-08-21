




@extends('layouts.admin')

@section('content')

<section class="section">
    <div class="container">
        <div class="row">
            @foreach($posts as $post)
                <div class="col-lg-6 mb-4">
                    <div class="card h-100">
                        @if($post->image_path)
                            <img src="{{ asset('storage/' . $post->image_path) }}" class="card-img-top img-fluid" alt="Post Image">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ Str::limit(strip_tags($post->content), 150, '...') }}</p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('posts.edit', $post) }}" class="btn btn-secondary">Edit</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
