@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            {{-- page title section --}}
            <div class="admin-page-title">
                <h3>{{ $post->post_title }}</h3>
                <small><i>Date : {{ $post->created_at->diffForHumans() }}</i></small>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            {{ $post->post_content }}
        </div>
    </div>
</div>
@endsection
