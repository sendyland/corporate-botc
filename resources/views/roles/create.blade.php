@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Create New Role</h2>
            </div>
        </div>
    </div>

    <!-- Menampilkan pesan kesalahan jika terdapat kesalahan input -->
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

    <!-- Form untuk membuat peran baru -->
    {!! Form::open(['route' => 'roles.store', 'method' => 'POST']) !!}
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
                            <td>{{ Form::checkbox('permission[]', '1', false, ['class' => 'name']) }}
                            </td>
                            <td>{{ Form::checkbox('permission[]', '2', false, ['class' => 'name']) }}
                            </td>
                            <td>{{ Form::checkbox('permission[]', '3', false, ['class' => 'name']) }}
                            </td>
                            <td>{{ Form::checkbox('permission[]', '4', false, ['class' => 'name']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>Product</td>
                            <td>{{ Form::checkbox('permission[]', '5', false, ['class' => 'name']) }}
                            </td>
                            <td>{{ Form::checkbox('permission[]', '6', false, ['class' => 'name']) }}
                            </td>
                            <td>{{ Form::checkbox('permission[]', '7', false, ['class' => 'name']) }}
                            </td>
                            <td>{{ Form::checkbox('permission[]', '8', false, ['class' => 'name']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>User</td>
                            <td>{{ Form::checkbox('permission[]', '9', false, ['class' => 'name']) }}
                            </td>
                            <td>{{ Form::checkbox('permission[]', '10', false, ['class' => 'name']) }}
                            </td>
                            <td>{{ Form::checkbox('permission[]', '11', false, ['class' => 'name']) }}
                            </td>
                            <td>{{ Form::checkbox('permission[]', '12', false, ['class' => 'name']) }}
                            </td>
                        </tr>
                        <!-- Tambahkan baris tambahan untuk setiap izin -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <!-- Tombol submit untuk menyimpan peran baru -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
