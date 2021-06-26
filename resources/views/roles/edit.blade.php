@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        {{-- page title --}}
        <div class="col-md-12">
            <div class="admin-page-title">
                <h3>{{ __('Edit role') }}</h3>
            </div>
        </div>

        {{-- page contents --}}
        <div class="col-md-5">
            <div class="admin-page-content">
                <form action="{{ route('roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('patch')

                    {{-- role name --}}
                    <div class="mb-3">
                        <input  type="text" name="name" placeholder="Role name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ?? $role->name }}">
                        @error('name') <div class="invalid-feedback mb-3">{{ $message }}</div> @enderror
                    </div>

                    {{-- permission list --}}
                    <div class="mb-3">
                        <strong>Permissions : </strong><br>
                        @forelse ($permission as $value)
                            <label class="pl-3">
                                <input
                                    type="checkbox" name="permission[]" value="{{ $value->id }}"
                                    {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }} >
                                {{ $value->name }}
                            </label>
                        @empty
                            {{ __('You have no permissions yet') }}
                        @endforelse
                    </div>

                    {{-- submit button --}}
                    <div class="mb-3 float-right">
                        <input type="submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
