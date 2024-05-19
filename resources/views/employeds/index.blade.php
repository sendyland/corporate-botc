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
                        @can('employed-delete')
                            <th>Asal Company</th>
                        @endcan
                        <th>Nama Lengkap</th>
                        <th>TTL</th>
                        <th>Jenis Kelamin</th>
                        <th>Telp</th>
                        <th>Email</th>
                        <th>Position</th>
                        <th>Persyaratan</th>
                        <th>Register Learning</th>
                        <th>Enroll Course</th>
                        @canany(['employed-edit', 'employed-delete'])
                            <th width="160px">Action</th>
                        @endcanany

                    </tr>
                    @foreach ($employeds as $employed)
                        <tr>
                            <td>{{ ++$i }}</td>
                            @can('employed-delete')
                                <td>{{ $employed->company->name }}</td>
                            @endcan
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
                            <td>
                                @if ($employed->status_woo == 0)
                                    <span class="badge bg-warning">Belum Register</span>
                                @else
                                    <span class="badge bg-info">Sudah Register</span>
                                @endif
                            </td>
                            <td></td>
                            @canany(['employed-view', 'employed-edit', 'employed-delete'])
                                <td>
                                    <form action="{{ route('employeds.destroy', $employed->id) }}" method="POST">
                                        <a href="#" order="{{ $employed->id }}" class="print btn btn-primary btn-sm"
                                            data-bs-toggle="modal" data-bs-target="#ExtralargeModal{{ $employed->id }}">
                                            <i class="bi bi-printer"></i>
                                        </a>
                                        <div class="modal fade" id="ExtralargeModal{{ $employed->id }}" tabindex="-1"
                                            style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-l">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Detail Company {{ $employed->company->name }}
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body" id="loadorder">
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <td>Nama Perusahaan</td>
                                                                <td> {{ $employed->company->name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Nama Lengkap</td>
                                                                <td>{{ $employed->name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Tempat Lahir :</td>
                                                                <td>{{ $employed->tempat_lahir }}</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">OK</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @can('employed-edit')
                                            <a class="btn btn-warning btn-sm"
                                                href="{{ route('employeds.edit', $employed->id) }}"><i
                                                    class="bi bi-pencil"></i></a>
                                        @endcan

                                        @csrf
                                        @method('DELETE')
                                        @can('employed-delete')
                                            <button type="submit" class="btn btn-danger btn-sm"><i
                                                    class="bi bi-trash"></i></button>
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
