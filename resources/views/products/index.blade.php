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
                <h3>{{ __('Products Management') }}</h3>
            </div>
            <div class="admin-page-btn-add-new my-3">
                <a class="btn btn-primary" href="{{ route('products.create') }}">{{ __('Create New Product') }}</a>
                <a class="btn btn-success" href="{{ route('products.export') }}">{{ __('Export') }}</a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="ProductTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Date Created</th>
                            <th width="280px">Action</th>
                        </tr>
                    </thead>

                    {{-- <tbody>
                        @forelse ($products as $key => $value)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $value->post_title }}</td>
                                <td>{{ $value->created_at }}</td>
                                <td>
                                    <a class="btn btn-dark" href="{{ route('products.show', $value->id) }}">View</a>
                                    @can('role-edit')
                                        <a class="btn btn-success" href="{{ route('products.edit', $value->id) }}">Edit</a>
                                    @endcan
                                    @can('role-delete')
                                        <form
                                            action="{{ route('products.destroy', $value->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Delete it ?')">
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
                    </tbody> --}}

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

    // $('#ProductTable').DataTable();

    $('#ProductTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('products.api') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'post_title', name: 'post_title' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ],
    });
});
</script>
@endpush
