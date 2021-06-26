@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            {{-- page title --}}
            <div class="admin-page-title">
                <h3>{{ __('Roles Management') }}</h3>
            </div>
            <div class="admin-page-btn-add-new my-3">
                <a class="btn btn-primary" href="{{ route('roles.create') }}">
                    {{ __('Create New Role') }}
                </a>
            </div>

            {{-- page content --}}
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>{{ __('No') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th width="280px">{{ __('Action') }}</th>
                    </tr>
                    @forelse ($roles as $key => $value)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $value->name }}</td>
                            <td>
                                <a class="btn btn-dark" href="{{ route('roles.show', $value->id) }}">View</a>
                                @can('role-edit')
                                    <a class="btn btn-success" href="{{ route('roles.edit', $value->id) }}">Edit</a>
                                @endcan
                                @can('role-delete')
                                    <form
                                        action="{{ route('roles.destroy', $value->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Delete it ?')" >
                                        @csrf
                                        @method('delete')
                                        <input type="submit" class="btn btn-danger" value="Delete">
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No data avalaible</td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
