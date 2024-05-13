@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Employed</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Employed</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    @can('employed-create')
        <a class="btn btn-success" href="{{ route('employeds.create') }}"> Create Employed</a>
    @endcan

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="col-12 mt-2">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">All Employees</h5>
                <table class="table table-bordered mt-2">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Position</th>
                        {{-- <th>Company</th> --}}
                        <th width="280px">Action</th>
                    </tr>
                    @foreach ($employeds as $employed)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $employed->name }}</td>
                            <td>{{ $employed->email }}</td>
                            <td>{{ $employed->position }}</td>
                            {{-- <td>{{ $employed->user->name }}</td> --}}
                            <td>
                                <form action="{{ route('employeds.destroy', $employed->id) }}" method="POST">
                                    @can('employed-edit')
                                        <a class="btn btn-primary" href="{{ route('employeds.edit', $employed->id) }}">Edit</a>
                                    @endcan

                                    @csrf
                                    @method('DELETE')
                                    @can('employed-delete')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    @endcan
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>

                <div class="pagination d-flex justify-content-between align-items-center">
                    {!! $employeds->links('vendor.pagination.bootstrap-5') !!}
                </div>
            </div>
        </div>
    </div>
@endsection
