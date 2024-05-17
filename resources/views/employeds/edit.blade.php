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
        <form action="{{ route('employeds.update', $employed->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-2">
                <h5>Edit Peserta</h5>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nama Lengkap:</strong>
                        <input type="text" name="name" class="form-control" required placeholder="Name"
                            value="{{ $employed->name }}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Tempat Lahir:</strong>
                        <input type="text" name="tempat_lahir" class="form-control" required placeholder="Kota Kelahiran"
                            value="{{ $employed->tempat_lahir }}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Tanggal Lahir:</strong>
                        <input type="date" name="tgl_lahir" class="form-control" required
                            value="{{ $employed->tgl_lahir }}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Jenis Kelamin:</strong>
                        <select class="form-control" name="jk">
                            <option>Jenis Kelamin</option>
                            <option value="1" {{ $employed->jk == 1 ? 'selected' : '' }}>Laki-Laki</option>
                            <option value="2" {{ $employed->jk == 2 ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>No Telp:</strong>
                        <input type="text" name="telp" class="form-control" placeholder="No Telp"
                            value="{{ $employed->telp }}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Email:</strong> <span class="badge bg-warning text-dark">Perubahan Email Bisa Kontak
                            langsung Admin</span>
                        <input disabled type="email" name="email" class="form-control" placeholder="Email"
                            value="{{ $employed->email }}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Position:</strong>
                        <input type="text" name="position" class="form-control" placeholder="Position"
                            value="{{ $employed->position }}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </form>

    </div>

@endsection
