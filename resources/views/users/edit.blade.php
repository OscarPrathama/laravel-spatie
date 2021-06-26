@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            {{-- page title section --}}
            <div class="admin-page-title">
                <h3>{{ __('Edit user') }}</h3>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
            {{-- form section --}}
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('patch')
                <div class="mb-3">
                    <input  type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            placeholder="Name" value="{{ old('name') ?? $user->name }}">
                    @error('name') <div class="invalid-feedback mb-3">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <input  type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            placeholder="Email" value="{{ old('email') ?? $user->email }}">
                    @error('email') <div class="invalid-feedback mb-3">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    @error('password') <div class="invalid-feedback mb-3">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <input type="password" name="confirm-password" class="form-control" placeholder="Confirm Password">
                    @error('confirm-password') <div class="invalid-feedback mb-3">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <strong>Role : </strong><br>
                    <select name="roles[]" multiple class="form-control">
                        @forelse ($roles as $item)
                            <option value="{{ $item }}" {{ in_array($item, $userRole) ? "selected" : "" }}>
                                {{ $item }}
                            </option>
                        @empty
                            -
                        @endforelse
                    </select>
                    @error('roles') <div class="invalid-feedback mb-3">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3 float-right">
                    <input type="submit" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
