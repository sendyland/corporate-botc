@extends('layouts.app')

@section('css')
    <style>
        .form-group {
            line-height: 30px;
        }

        .loading-overlay {
            display: none;
            /* Hidden by default */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .loading-spinner {
            border: 8px solid #f3f3f3;
            border-top: 8px solid #3498db;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 2s linear infinite;
        }

        .loading-text {
            color: #fff;
            margin-top: 20px;
            font-size: 18px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
@endsection

@section('content')
    <div class="pagetitle">
        <h1>Create Employed</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Employed</li>
                <li class="breadcrumb-item active">Create</li>
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
        <form id="myForm" action="{{ route('employeds.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-2">
                <div class="col-8"></div>
                <h5>Pendaftaran Peserta</h5>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <strong>Nama Lengkap</strong>
                        <input type="text" name="name" class="form-control" required placeholder="Name">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <strong>Tempat Lahir</strong>
                        <input type="text" name="tempat_lahir" class="form-control" required
                            placeholder="Kota Kelahiran">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <strong>Email</strong>
                        <input type="email" name="email" class="form-control" placeholder="Email">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <strong>Tanggal Lahir</strong>
                        <input type="date" name="tgl_lahir" class="form-control" required>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <strong>Jenis Kelamin</strong>
                        <select class="form-control" name="jk">
                            <option>Jenis Kelamin</option>
                            <option value="1">Laki-Laki</option>
                            <option value="2">Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <strong>No Telp</strong>
                        <input type="text" name="telp" class="form-control" placeholder="No Telp">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <strong>Position</strong>
                        <input type="text" name="position" class="form-control" placeholder="Position">
                    </div>
                </div>
                <!-- File Upload -->
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <strong>File KTP</strong>
                        <input type="file" name="file_ktp" class="form-control">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <strong>File Foto</strong>
                        <input type="file" name="file_foto" class="form-control">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <strong>File Ijazah</strong>
                        <input type="file" name="file_ijazah" class="form-control">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <strong>File CV</strong>
                        <input type="file" name="file_cv" class="form-control">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <strong>File Seamanbook</strong>
                        <input type="file" name="file_seamanbook" class="form-control">
                    </div>
                </div>
                <!-- End File Upload -->
                <div class="col-lg-12 col-md-6 mt-2">
                    <button type="submit" class="btn btn-primary">Tambah Peserta</button>
                </div>
            </div>
        </form>
        <!-- Loading Overlay -->
        <div id="loading" class="loading-overlay">
            <div class="loading-spinner"></div>
            <div class="loading-text">Loading - Insert Data User Learning</div>
        </div>
    </div>
@endsection

@section('myscript')
    <script>
        document.getElementById('myForm').addEventListener('submit', function(event) {
            document.getElementById('loading').style.display = 'flex';
        });
    </script>
@endsection
