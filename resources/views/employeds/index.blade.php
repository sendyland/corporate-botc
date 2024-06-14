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
                                @if ($employed->wp_id)
                                    <span class="badge bg-info">Terdaftar</span>
                                @else
                                    <span class="badge bg-warning">Belum Terdaftar</span><br>
                                    <span class="badge bg-warning">Hubungi Admin</span>
                                @endif

                            </td>
                            <td></td>
                            @canany(['employed-view', 'employed-edit', 'employed-delete'])
                                <td>
                                    <form id="delete-form-{{ $employed->id }}"
                                        action="{{ route('employeds.destroy', $employed->id) }}" method="POST">

                                        <a href="#" order="{{ $employed->id }}" class="print btn btn-primary btn-sm"
                                            data-bs-toggle="modal" data-bs-target="#ExtralargeModal{{ $employed->id }}">
                                            <i class="bi bi-printer"></i>
                                        </a>
                                        <div class="modal fade" id="ExtralargeModal{{ $employed->id }}" tabindex="-1"
                                            style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-l">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Detail Employed Company
                                                            {{ $employed->company->name }}
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
                                                            <!-- File Upload -->
                                                            <tr>
                                                                <td>File KTP</td>
                                                                <td>
                                                                    @if ($employed->file_ktp)
                                                                        @php
                                                                            $allowedExtensions = [
                                                                                '.jpg',
                                                                                '.jpeg',
                                                                                '.png',
                                                                                '.gif',
                                                                                '.bmp',
                                                                            ];
                                                                            $fileExtension = strtolower(
                                                                                pathinfo(
                                                                                    $employed->file_ktp,
                                                                                    PATHINFO_EXTENSION,
                                                                                ),
                                                                            );
                                                                        @endphp
                                                                        @if (in_array($fileExtension, $allowedExtensions))
                                                                            <img src="{{ asset('storage/' . $employed->file_ktp) }}"
                                                                                alt="KTP Image" style="max-width: 100px;">
                                                                        @else
                                                                            <a href="{{ asset('storage/' . $employed->file_ktp) }}"
                                                                                target="_blank">View File</a>
                                                                        @endif
                                                                    @else
                                                                        No file uploaded
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>File Foto</td>
                                                                <td>
                                                                    @if ($employed->file_foto)
                                                                        @php
                                                                            $fileExtension = strtolower(
                                                                                pathinfo(
                                                                                    $employed->file_foto,
                                                                                    PATHINFO_EXTENSION,
                                                                                ),
                                                                            );
                                                                        @endphp
                                                                        @if (in_array($fileExtension, $allowedExtensions))
                                                                            <img src="{{ asset('storage/' . $employed->file_foto) }}"
                                                                                alt="Foto Image" style="max-width: 100px;">
                                                                        @else
                                                                            <a href="{{ asset('storage/' . $employed->file_foto) }}"
                                                                                target="_blank">View File</a>
                                                                        @endif
                                                                    @else
                                                                        No file uploaded
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>File Ijazah</td>
                                                                <td>
                                                                    @if ($employed->file_ijazah)
                                                                        @php
                                                                            $fileExtension = strtolower(
                                                                                pathinfo(
                                                                                    $employed->file_ijazah,
                                                                                    PATHINFO_EXTENSION,
                                                                                ),
                                                                            );
                                                                        @endphp
                                                                        @if (in_array($fileExtension, $allowedExtensions))
                                                                            <img src="{{ asset('storage/' . $employed->file_ijazah) }}"
                                                                                alt="Ijazah Image" style="max-width: 100px;">
                                                                        @else
                                                                            <a href="{{ asset('storage/' . $employed->file_ijazah) }}"
                                                                                target="_blank">View File</a>
                                                                        @endif
                                                                    @else
                                                                        No file uploaded
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>File CV</td>
                                                                <td>
                                                                    @if ($employed->file_cv)
                                                                        @php
                                                                            $fileExtension = strtolower(
                                                                                pathinfo(
                                                                                    $employed->file_cv,
                                                                                    PATHINFO_EXTENSION,
                                                                                ),
                                                                            );
                                                                        @endphp
                                                                        @if (in_array($fileExtension, $allowedExtensions))
                                                                            <img src="{{ asset('storage/' . $employed->file_cv) }}"
                                                                                alt="CV Image" style="max-width: 100px;">
                                                                        @else
                                                                            <a href="{{ asset('storage/' . $employed->file_cv) }}"
                                                                                target="_blank">View File</a>
                                                                        @endif
                                                                    @else
                                                                        No file uploaded
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>File Seamanbook</td>
                                                                <td>
                                                                    @if ($employed->file_seamanbook)
                                                                        @php
                                                                            $fileExtension = strtolower(
                                                                                pathinfo(
                                                                                    $employed->file_seamanbook,
                                                                                    PATHINFO_EXTENSION,
                                                                                ),
                                                                            );
                                                                        @endphp
                                                                        @if (in_array($fileExtension, $allowedExtensions))
                                                                            <img src="{{ asset('storage/' . $employed->file_seamanbook) }}"
                                                                                alt="Seamanbook Image"
                                                                                style="max-width: 100px;">
                                                                        @else
                                                                            <a href="{{ asset('storage/' . $employed->file_seamanbook) }}"
                                                                                target="_blank">View File</a>
                                                                        @endif
                                                                    @else
                                                                        No file uploaded
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <!-- End File Upload -->

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
                                            <button type="button" class="btn btn-danger btn-sm delete-employed"
                                                data-employee-id="{{ $employed->id }}">
                                                <i class="bi bi-trash"></i>
                                            </button>
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
@section('myscript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-employed');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const employedId = this.getAttribute('data-employee-id');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You will not be able to recover this employed!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Submit form
                            const form = document.getElementById(
                                `delete-form-${employedId}`);
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
