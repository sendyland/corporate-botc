@extends('layouts.app')


@section('content')
    <div class="pagetitle">
        <h1>Role Management</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Role</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="pull-right">
        @can('role-create')
            <a class="btn btn-success" href="{{ route('roles.create') }}"> Create Role</a>
        @endcan
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="col-12 mt-2">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">All Role</h5>
                <table class="table table-bordered mt-2">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th width="280px">Action</th>
                    </tr>
                    @foreach ($roles as $key => $role)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                @can('role-edit')
                                    <a class="btn btn-warning btn-sm" href="{{ route('roles.edit', $role->id) }}"><i
                                            class="bi bi-pencil"></i></a>
                                @endcan
                                @can('role-delete')
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'style' => 'display:inline']) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-danger']) !!}
                                    {!! Form::close() !!}
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </table>

                <div class="pagination d-flex justify-content-between align-items-center">
                    {!! $roles->links('vendor.pagination.bootstrap-5') !!}
                </div>
            </div>
        </div>
    </div>
@endsection
