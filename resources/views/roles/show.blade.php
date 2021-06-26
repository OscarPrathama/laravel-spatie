@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            {{-- page title --}}
            <div class="admin-page-title">
                <h3>Your Role</h3>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th><b>Role</b></th>
                        <th><strong>Permissions</strong></th>
                    </tr>
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>
                            @if (!empty($rolePermissions))
                                @foreach ($rolePermissions as $item)
                                    {{ $item->name }},
                                @endforeach
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
