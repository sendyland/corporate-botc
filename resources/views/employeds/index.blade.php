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
                        <th>Nama Lengkap</th>
                        <th>TTL</th>
                        <th>Jenis Kelamin</th>
                        <th>Telp</th>
                        <th>Email</th>
                        <th>Position</th>
                        <th>Persyaratan</th>
                        <th>Enroll Course</th>
                        @canany(['employed-edit', 'employed-delete'])
                            <th width="280px">Action</th>
                        @endcanany

                    </tr>
                    @foreach ($employeds as $employed)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $employed->name }}</td>
                            <td>{{ $employed->tempat_lahir . ',' }} {{ $employed->tgl_lahir }}</td>
                            <td>
                                @if ($employed->jk == 1)
                                    Laki-Laki
                                @else
                                    Perempuan
                                @endif
                            </td>
                            <td>{{ $employed->telp }}</td>
                            <td>{{ $employed->email }}</td>
                            <td>{{ $employed->position }}</td>
                            <td>{{ $employed->status }}</td>
                            <td></td>
                            @canany(['employed-edit', 'employed-delete'])
                                <td>
                                    <form action="{{ route('employeds.destroy', $employed->id) }}" method="POST">
                                        @can('employed-edit')
                                            @if ($employed->status == 'Lengkapi')
                                                <a class="btn btn-primary btn-sm"
                                                    href="{{ route('employeds.edit', $employed->id) }}">Edit</a>
                                            @endif
                                        @endcan

                                        @csrf
                                        @method('DELETE')
                                        @can('employed-delete')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        @endcan
                                    </form>
                                </td>
                            @endcanany
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
