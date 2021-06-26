@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            {{-- page title section --}}
            <div class="admin-page-title">
                <h3>{{ $user->name }}</h3>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-5">

            {{-- form section --}}
            <div class="mb-3">
                <input  type="text" name="name" class="form-control"
                        placeholder="Name" value="{{ old('name') ?? $user->name }}">
            </div>
            <div class="mb-3">
                <input  type="text" name="email" class="form-control"
                        placeholder="Email" value="{{ old('email') ?? $user->email }}">
            </div>
            <div class="mb-3">
                <strong>Role : </strong>
                @forelse ($user->getRoleNames() as $item)
                    <label class="badge badge-success">{{ $item }}</label>
                @empty
                    -
                @endforelse
            </div>

        </div>
    </div>
</div>
@endsection
