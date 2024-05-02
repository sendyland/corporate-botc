@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Role</h2>
            </div>
        </div>
    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::model($role, ['method' => 'PATCH', 'route' => ['roles.update', $role->id]]) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Permissions:</strong>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>List</th>
                            <th>Create</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Role</td>
                            <td>{{ Form::checkbox('permission[1][]', '1', in_array(1, $rolePermissions) ? true : false, ['class' => 'name']) }}
                            </td>
                            <td>{{ Form::checkbox('permission[1][]', '2', in_array(2, $rolePermissions) ? true : false, ['class' => 'name']) }}
                            </td>
                            <td>{{ Form::checkbox('permission[1][]', '3', in_array(3, $rolePermissions) ? true : false, ['class' => 'name']) }}
                            </td>
                            <td>{{ Form::checkbox('permission[1][]', '4', in_array(4, $rolePermissions) ? true : false, ['class' => 'name']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>Product</td>
                            <td>{{ Form::checkbox('permission[2][]', '5', in_array(5, $rolePermissions) ? true : false, ['class' => 'name']) }}
                            </td>
                            <td>{{ Form::checkbox('permission[2][]', '6', in_array(6, $rolePermissions) ? true : false, ['class' => 'name']) }}
                            </td>
                            <td>{{ Form::checkbox('permission[2][]', '7', in_array(7, $rolePermissions) ? true : false, ['class' => 'name']) }}
                            </td>
                            <td>{{ Form::checkbox('permission[2][]', '8', in_array(8, $rolePermissions) ? true : false, ['class' => 'name']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>User</td>
                            <td>{{ Form::checkbox('permission[3][]', '9', in_array(9, $rolePermissions) ? true : false, ['class' => 'name']) }}
                            </td>
                            <td>{{ Form::checkbox('permission[3][]', '10', in_array(10, $rolePermissions) ? true : false, ['class' => 'name']) }}
                            </td>
                            <td>{{ Form::checkbox('permission[3][]', '11', in_array(11, $rolePermissions) ? true : false, ['class' => 'name']) }}
                            </td>
                            <td>{{ Form::checkbox('permission[3][]', '12', in_array(12, $rolePermissions) ? true : false, ['class' => 'name']) }}
                            </td>
                        </tr>
                        <!-- Tambahkan baris tambahan untuk setiap izin -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
