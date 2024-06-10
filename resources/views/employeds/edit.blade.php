@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Edit Employed</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Employed</li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row hero">
        <form action="{{ route('employeds.update', $employed->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-2">
                <h5>Edit Peserta</h5>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Nama Lengkap:</strong>
                        <input type="text" name="name" class="form-control" required placeholder="Name"
                            value="{{ old('name', $employed->name) }}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Tempat Lahir:</strong>
                        <input type="text" name="tempat_lahir" class="form-control" required placeholder="Kota Kelahiran"
                            value="{{ old('tempat_lahir', $employed->tempat_lahir) }}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Tanggal Lahir:</strong>
                        <input type="date" name="tgl_lahir" class="form-control" required
                            value="{{ old('tgl_lahir', $employed->tgl_lahir) }}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Jenis Kelamin:</strong>
                        <select class="form-control" name="jk" required>
                            <option value="1" {{ old('jk', $employed->jk) == 1 ? 'selected' : '' }}>Laki-Laki</option>
                            <option value="2" {{ old('jk', $employed->jk) == 2 ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>No Telp:</strong>
                        <input type="text" name="telp" class="form-control" placeholder="No Telp"
                            value="{{ old('telp', $employed->telp) }}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Email:</strong>
                        @if ($disable === 'disabled')
                            <span class="badge bg-warning text-dark">Perubahan Email Bisa Kontak langsung Admin</span>
                        @endif
                        <input {{ $disable }} type="email" name="email" class="form-control" placeholder="Email"
                            value="{{ old('email', $employed->email) }}" {{ $disable }}>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Position:</strong>
                        <input type="text" name="position" class="form-control" placeholder="Position"
                            value="{{ old('position', $employed->position) }}">
                    </div>
                </div>
                <!-- File Upload Fields -->
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>File KTP:</strong>
                        <input type="file" name="file_ktp" class="form-control">
                        @if ($employed->file_ktp)
                            <a href="{{ asset('storage/' . $employed->file_ktp) }}" target="_blank">View File</a>
                        @else
                            <span>No file uploaded</span>
                        @endif
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>File Foto:</strong>
                        <input type="file" name="file_foto" class="form-control">
                        @if ($employed->file_foto)
                            <a href="{{ asset('storage/' . $employed->file_foto) }}" target="_blank">View File</a>
                        @else
                            <span>No file uploaded</span>
                        @endif
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>File Ijazah:</strong>
                        <input type="file" name="file_ijazah" class="form-control">
                        @if ($employed->file_ijazah)
                            <a href="{{ asset('storage/' . $employed->file_ijazah) }}" target="_blank">View File</a>
                        @else
                            <span>No file uploaded</span>
                        @endif
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>File CV:</strong>
                        <input type="file" name="file_cv" class="form-control">
                        @if ($employed->file_cv)
                            <a href="{{ asset('storage/' . $employed->file_cv) }}" target="_blank">View File</a>
                        @else
                            <span>No file uploaded</span>
                        @endif
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>File Seamanbook:</strong>
                        <input type="file" name="file_seamanbook" class="form-control">
                        @if ($employed->file_seamanbook)
                            <a href="{{ asset('storage/' . $employed->file_seamanbook) }}" target="_blank">View File</a>
                        @else
                            <span>No file uploaded</span>
                        @endif
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </form>

    </div>

@endsection
