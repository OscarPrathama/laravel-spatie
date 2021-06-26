@extends('layouts.app')

@section('style')
<link href="{{ asset('vendor/datatables/css/bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            {{-- page title --}}
            <div class="admin-page-title">
                <h3>{{ __('Users Management') }}</h3>
            </div>
            <div class="admin-page-btn-add-new my-3">
                <a class="btn btn-primary" href="{{ route('users.create') }}">{{ __('Create New User') }}</a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="UserTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th width="280px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($Users as $key => $value)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->email }}</td>
                                <td>
                                    @if (!empty($value->getRoleNames()))
                                        @foreach ($value->getRoleNames() as $role)
                                            <label class="badge badge-success p-2">{{ $role }}</label>
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-dark" href="{{ route('users.show', $value->id) }}">View</a>
                                    @can('role-edit')
                                        <a class="btn btn-success" href="{{ route('users.edit', $value->id) }}">Edit</a>
                                    @endcan
                                    @can('role-delete')
                                        <form action="{{ route('users.destroy', $value->id) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('Delete it ?')">
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}" defer></script>
<script src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.min.js') }}" defer></script>
<script>
$(function() {
    $('#UserTable').DataTable();
});
</script>
@endpush
