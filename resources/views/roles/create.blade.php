@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        {{-- page title --}}
        <div class="col-md-12">
            <div class="admin-page-title">
                <h3>Create role</h3>
            </div>
        </div>

        {{-- page contents --}}
        <div class="col-md-5">
            <div class="admin-page-content">
                <form action="{{ route('roles.store') }}" method="POST">
                    @csrf

                    {{-- role name --}}
                    <div class="mb-3">
                        <input  type="text" name="name" placeholder="Role name"
                                class="form-control @error('name') is-invalid @enderror">
                        @error('name') <div class="invalid-feedback mb-3">{{ $message }}</div> @enderror
                    </div>

                    {{-- permission list --}}
                    <div class="mb-3">
                        @forelse ($permissions as $value)
                            <label class="pl-3">
                                <input type="checkbox" name="permission[]" value="{{ $value->id }}" >
                                {{ $value->name }}
                            </label>
                        @empty
                            {{ __('No Permission list') }}
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
