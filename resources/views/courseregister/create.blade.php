@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Register Course</h1>
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
        <!--begin::Content-->
        <div class="col-lg-12">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card body-->
                <div class="card-body p-12">
                    <!--begin::Form-->
                    <form action="{{ route('course.registration') }}" method="POST">
                        @csrf
                        <!--begin::Wrapper-->
                        <!--begin::Separator-->
                        <h5 class="card-title">Register Peserta Course</h5>
                        <!--end::Separator-->
                        <!--begin::Wrapper-->
                        <div class="mb-0">
                            <!--begin::Table wrapper-->
                            <div class="table-responsive mb-10">
                                <!--begin::Table-->
                                <table class="table table-bordered mt-2" data-kt-element="items">
                                    <!--begin::Table head-->
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Peserta</th>
                                            <th>Program Course</th>
                                            <th>Harga</th>
                                            <th>
                                                <a href="#" class="btn btn-primary btn-sm" id="add-row"><i
                                                        class="bi bi-plus"></i></a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody id="item-table">
                                        <tr class="border-bottom border-bottom-dashed">
                                            <td class="item-number">1</td>
                                            <td class="pe-7">
                                                <select
                                                    class="form-control name-select @error('program') is-invalid @enderror"
                                                    name="name[]" required>
                                                    <option value="" disabled selected>Pilih Nama Peserta</option>
                                                    @foreach ($employeds as $employed)
                                                        <option value="{{ $employed->id }}"
                                                            {{ old('program') == $employed->id ? 'selected' : '' }}>
                                                            {{ $employed->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select
                                                    class="form-control program-select @error('program') is-invalid @enderror"
                                                    name="program[]" required>
                                                    <option value="" disabled selected>Pilih Program</option>
                                                    @foreach ($allcourses as $course)
                                                        <option value="{{ $course->id }}"
                                                            data-price="{{ $course->price }}"
                                                            {{ old('program') == $course->id ? 'selected' : '' }}>
                                                            {{ $course->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><span class="price-program"><input class="form-control" name="price[]"
                                                        value="0" type="text" readonly></span></td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-icon btn-danger remove-row">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <!--end::Table body-->
                                    <!--begin::Table foot-->
                                    <tfoot>
                                        <tr class="border-top border-top-dashed align-top fs-6 fw-bold text-gray-700">
                                            <th class="text-primary"></th>
                                            <th></th>
                                            <th class="border-bottom border-bottom-dashed ps-0">
                                                <div class="d-flex flex-column align-items-end">
                                                    <div class="fs-6">Subtotal</div>
                                                </div>
                                            </th>
                                            <th class="border-bottom border-bottom-dashed text-end">Rp
                                                <span id="sub-total">0.00</span>
                                            </th>
                                            <th></th>
                                        </tr>
                                        <tr class="align-top fw-bold text-gray-700">
                                            <th></th>
                                            <th></th>
                                            <th class="fs-6 text-end">Total</th>
                                            <th class="text-end fs-6 text-nowrap">Rp
                                                <span id="grand-total">0.00</span>
                                            </th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <!--end::Table foot-->
                                </table>
                            </div>
                            <!--end::Table-->
                            <!--begin::Notes-->
                            <div class="mb-0">
                                <label class="form-label fs-6 fw-bold text-gray-700">Notes</label>
                                <textarea name="noted" class="form-control form-control-solid" rows="3"
                                    placeholder="Berikan Note Untuk Admin jika ada"></textarea>
                            </div>
                            <div class="mt-2">
                                <button class="btn btn-primary">Daftarkan Peserta</button>
                            </div>
                            <!--end::Notes-->
                        </div>
                        <!--end::Wrapper-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Content-->
    </div>
@endsection

@section('myscript')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            let rowCount = $('#item-table tr').length;

            $('#add-row').click(function(e) {
                e.preventDefault();
                rowCount++;
                let newRow = `<tr class="border-bottom border-bottom-dashed">
                    <td class="item-number">${rowCount}</td>
                    <td class="pe-7">
                        <select class="form-control name-select" name="name[]" required>
                            <option value="" disabled selected>Pilih Nama Peserta</option>
                            @foreach ($employeds as $employed)
                                <option value="{{ $employed->id }}">{{ $employed->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="form-control program-select" name="program[]" required>
                            <option value="" disabled selected>Pilih Program</option>
                            @foreach ($allcourses as $course)
                                <option value="{{ $course->id }}" data-price="{{ $course->price }}">
                                    {{ $course->title }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td><span class="price-program"><input class="form-control" name="price[]" value="0" type="text" readonly></span></td>
                    <td>
                        <button type="button" class="btn btn-sm btn-icon btn-danger remove-row">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>`;
                $('#item-table').append(newRow);
                updateRowNumbers();
                updateTotals();
            });

            $(document).on('click', '.remove-row', function() {
                $(this).closest('tr').remove();
                rowCount--;
                updateRowNumbers();
                updateTotals();
            });

            function updateRowNumbers() {
                $('#item-table tr').each(function(index) {
                    $(this).find('.item-number').text(index + 1);
                });
            }

            $(document).on('change', '.program-select', function() {
                let price = $(this).find('option:selected').data('price');
                $(this).closest('tr').find('input[name="price[]"]').val(price);
                updateTotals();
            });

            function updateTotals() {
                let subtotal = 0;
                $('#item-table input[name="price[]"]').each(function() {
                    subtotal += parseFloat($(this).val());
                });
                $('#sub-total').text(subtotal.toFixed(2));
                $('#grand-total').text(subtotal.toFixed(2));
            }

            // Panggil fungsi updateTotals() setelah baris ditambahkan atau dihapus
            $('#item-table').on('change', 'input[name="price[]"]', updateTotals);
            $('#item-table').on('DOMNodeInserted DOMNodeRemoved', updateTotals);
        });
    </script>
@endsection
