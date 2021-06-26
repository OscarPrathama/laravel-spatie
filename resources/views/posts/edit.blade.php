@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            {{-- page title section --}}
            <div class="admin-page-title">
                <h3>Edit Post</h3>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
            {{-- form section --}}
            <form action="{{ route('posts.update', $post->id) }}" method="POST">
                @csrf
                @method('put')
                <div class="mb-3">
                    <input  type="text" name="post_title" class="form-control @error('post_title') is-invalid @enderror"
                            placeholder="Post title" value="{{ old('post_title') ?? $post->post_title }}">
                    @error('post_title') <div class="invalid-feedback mb-3">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <textarea
                        name="post_content" cols="30" rows="8" class="form-control"
                        placeholder="Post content">{{ old('post_title') ?? $post->post_content }}</textarea>
                </div>
                <div class="mb-3 float-right">
                    <input type="submit" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
