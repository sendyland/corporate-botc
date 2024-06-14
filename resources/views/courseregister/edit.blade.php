@extends('layouts.app')

@section('css')
    <style>
        form {
            width: 100px !important;
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
        <h1>Preview Register Course</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Course</li>
                <li class="breadcrumb-item active">Register</li>
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

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-12">

                    <h5 class="card-title">Preview Peserta Course</h5>
                    <div class="row">
                        <div class="col">
                            <p>Perusahaan : {{ $courseRegistration->user->name }} </p>
                            <p>PIC Pembuat : {{ $courseRegistration->user->namepic }} </p>
                        </div>
                        <div class="col">
                            Dibuat : {{ $courseRegistration->created_at }}
                        </div>
                    </div>

                    <div class="mb-0">
                        <div class="table-responsive mb-10">
                            <table class="table table-bordered mt-2" data-kt-element="items">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Peserta</th>
                                        <th>Email</th>
                                        <th>Program Course</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>

                                <tbody id="item-table">
                                    @foreach ($courseRegistration->items as $index => $item)
                                        <tr class="border-bottom border-bottom-dashed">
                                            <td class="item-number">{{ $index + 1 }}</td>
                                            <td>{{ $item->employed->name }}</td>
                                            <td>{{ $item->employed->email }}</td>
                                            <td><a href="{{ $item->course->url }}">{{ $item->course->title }}</a></td>
                                            <td>{{ formatRupiah($item->price) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>

                                <tfoot>
                                    <tr class="border-top border-top-dashed align-top fs-6 fw-bold text-gray-700">
                                        <th class="text-primary"></th>
                                        <th></th>
                                        <th></th>
                                        <th class="border-bottom border-bottom-dashed ps-0">
                                            <div class="d-flex flex-column align-items-end">
                                                <div class="fs-6">Subtotal</div>
                                            </div>
                                        </th>
                                        <th class="border-bottom border-bottom-dashed text-end">Rp
                                            <span id="sub-total">{{ formatRupiah($totalPrice) }}</span>
                                        </th>

                                    </tr>
                                    <tr class="align-top fw-bold text-gray-700">
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th class="fs-6 text-end">Total</th>
                                        <th class="text-end fs-6 text-nowrap">Rp
                                            <span id="grand-total">{{ formatRupiah($totalPrice) }}</span>
                                        </th>

                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="mb-0">
                            <label class="form-label fs-6 fw-bold text-gray-700">Note</label>
                            <textarea name="noted" readonly class="form-control form-control-solid" rows="3"
                                placeholder="Berikan Note Untuk Admin jika ada">{{ $courseRegistration->noted }}</textarea>
                        </div>
                        <div class="row mt-2 form-action">
                            <form id="approveForm" action="{{ route('course-order.update', $courseRegistration->id) }}"
                                method="POST">
                                @csrf
                                @method('PUT') <!-- Tambahkan method PUT untuk update -->
                                <input type="hidden" name="status" value="1">
                                <button type="button" class="btn btn-primary" onclick="confirmApprove()">Approve</button>
                            </form>
                            <form id="declineForm" action="{{ route('course-order.update', $courseRegistration->id) }}"
                                method="POST">
                                @csrf
                                @method('PUT') <!-- Tambahkan method PUT untuk update -->
                                <input type="hidden" name="status" value="2">
                                <button type="button" class="btn btn-warning" onclick="confirmDecline()">Decline</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loading" class="loading-overlay">
        <div class="loading-spinner"></div>
        <div class="loading-text">Loading - Insert Data Learning</div>
    </div>
    <script>
        function confirmApprove() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to approve this course registration!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, approve it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('approveForm').submit();
                }
            });
        }

        function confirmDecline() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to decline this course registration!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, decline it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('declineForm').submit();
                }
            });
        }

        function showLoadingOverlay() {
            document.getElementById('loading').style.display = 'flex';
        }
    </script>
@endsection
