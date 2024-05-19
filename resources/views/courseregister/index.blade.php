@extends('layouts.app')

@section('css')
    <style>
        form {
            align-self: center;
            margin-bottom: 15px;
        }

        h5.card-title.product {
            font-size: 16px;
        }

        <style>body {
            background: #eee;
            margin-top: 20px;
        }

        .text-danger strong {
            color: #9f181c;
        }

        .receipt-main {
            background: #ffffff none repeat scroll 0 0;
            border-bottom: 12px solid #333333;
            border-top: 12px solid #012970;
            padding: 40px 30px !important;
            position: relative;
            box-shadow: 0 1px 21px #acacac;
            color: #333333;
            font-family: open sans;
        }

        .receipt-main p {
            color: #333333;
            font-family: open sans;
            line-height: 1.42857;
        }

        .receipt-footer h1 {
            font-size: 15px;
            font-weight: 400 !important;
            margin: 0 !important;
        }

        .receipt-main::after {
            background: #414143 none repeat scroll 0 0;
            content: "";
            height: 5px;
            left: 0;
            position: absolute;
            right: 0;
            top: -13px;
        }

        .receipt-right h5 {
            font-size: 16px;
            font-weight: bold;
            margin: 0 0 7px 0;
        }

        .receipt-right p {
            font-size: 12px;
            margin: 0px;
        }

        .receipt-right p i {
            text-align: center;
            width: 18px;
        }

        .receipt-main td {
            padding: 9px 20px !important;
        }

        .receipt-main th {
            padding: 13px 20px !important;
        }

        .receipt-main td {
            font-size: 13px;
            font-weight: initial !important;
        }

        .receipt-main td p:last-child {
            margin: 0;
            padding: 0;
        }

        .receipt-main td h2 {
            font-size: 20px;
            font-weight: 900;
            margin: 0;
            text-transform: uppercase;
        }

        .receipt-header-mid .receipt-left h1 {
            font-weight: 100;
            margin: 34px 0 0;
            text-align: right;
            text-transform: uppercase;
        }

        .receipt-header-mid {
            margin: 24px 0;
            overflow: hidden;
        }

        #container {
            background-color: #dcdcdc;
        }
    </style>
@endsection

@section('content')
    <div class="pagetitle">
        <h1>Register Course</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Register Courses</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <a class="btn btn-success" href="{{ route('course-order.create') }}"> Register Course</a>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="col-12 mt-2">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">All Courses Register</h5>
                <table class="table table-bordered mt-2">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Order</th>
                            <th>Company</th>
                            <th>PIC Name</th>
                            <th>Participant</th>
                            <th>Total Harga</th>
                            <th>Status Order</th>
                            <th>Status Payment</th>
                            <th width="130px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($courseregister as $order)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $order->company->name }}</td>
                                <td>{{ $order->company->namepic }}</td>
                                <td>{{ $order->participantCount }}</td>
                                <td>{{ $order->totalPrice }}</td>
                                <td>
                                    @if ($order->status == 0)
                                        <span class="badge bg-warning">Register Pending</span>
                                    @else
                                        <span class="badge bg-info">Register Approve</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($order->status == 3)
                                        <span class="badge bg-info text-light">Paid</span>
                                    @else
                                        <span class="badge bg-warning">Not Paid</span>
                                    @endif
                                </td>

                                <td>
                                    <form action="#" method="POST">
                                        <a href="#" order="{{ $order->id }}" class="print btn btn-primary btn-sm"
                                            data-bs-toggle="modal" data-bs-target="#ExtralargeModal{{ $order->id }}">
                                            <i class="bi bi-printer"></i>
                                        </a>
                                        <div class="modal fade" id="ExtralargeModal{{ $order->id }}" tabindex="-1"
                                            style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Detail Order</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body" id="loadorder">
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div
                                                                    class="receipt-main receipt-main-{{ $order->id }} col-xs-12 col-sm-12 col-md-12 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <div class="receipt-header">
                                                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                                                    <div class="receipt-left">
                                                                                        <img class="img-responsive"
                                                                                            alt="iamgurdeeposahan"
                                                                                            src="https://bootdey.com/img/Content/avatar/avatar6.png"
                                                                                            style="width: 71px; border-radius: 43px;">
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="col-xs-6 col-sm-6 col-md-6 text-right mt-2">
                                                                                    <div class="receipt-right">
                                                                                        <h5>{{ $order->company->name }}
                                                                                        </h5>
                                                                                        <p>Telp :
                                                                                            {{ $order->company->telp }} <i
                                                                                                class="fa fa-phone"></i></p>
                                                                                        <p>Email :
                                                                                            {{ $order->company->email }} <i
                                                                                                class="fa fa-envelope-o"></i>
                                                                                        </p>
                                                                                        <p>Alamat :
                                                                                            {{ $order->company->address }}
                                                                                            <i
                                                                                                class="fa fa-location-arrow"></i>
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <div class="receipt-header">
                                                                                <div
                                                                                    class="col-xs-8 col-sm-8 col-md-8 text-left">
                                                                                    <div class="receipt-right">
                                                                                        <h5>PIC :
                                                                                            {{ $order->company->namepic }}
                                                                                        </h5>
                                                                                        <p><b>INVOICE :
                                                                                                {{ $order->order_number }}</b>
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <table width="100%" class="table table-bordered mt-4">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Nama Peserta</th>
                                                                                <th>Course</th>
                                                                                <th>Amount</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($order->items as $item)
                                                                                <tr>
                                                                                    <td>{{ $item->employed->name }}</td>
                                                                                    <td>{{ $item->course->title }}</td>
                                                                                    <td>{{ formatRupiah($item->price) }}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                            <tr>
                                                                                <td></td>
                                                                                <td class="text-right">
                                                                                    <p><strong>Sub Amount: </strong></p>
                                                                                    <p><strong>Fees: </strong></p>

                                                                                </td>
                                                                                <td>
                                                                                    <p><strong>{{ formatRupiah($order->items->sum('price')) }}</strong>
                                                                                    </p>
                                                                                    <p><strong>-</strong>
                                                                                    </p>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td></td>
                                                                                <td class="text-right">
                                                                                    <h2><strong>Total: </strong></h2>
                                                                                </td>
                                                                                <td class="text-left text-danger">
                                                                                    <h2><strong>{{ formatRupiah($order->items->sum('price')) }}</strong>
                                                                                    </h2>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <div class="row">
                                                                        <div
                                                                            class="receipt-header receipt-header-mid receipt-footer">
                                                                            <div
                                                                                class="col-xs-8 col-sm-8 col-md-8 text-left">
                                                                                <div class="receipt-right">
                                                                                    <p><b>Date :</b>
                                                                                        {{ $order->created_at }}</p>

                                                                                    <h5>

                                                                                        Status Register : @if ($order->status == 0)
                                                                                            <span
                                                                                                class="badge bg-warning">Register
                                                                                                Pending</span>
                                                                                        @else
                                                                                            <span
                                                                                                class="badge bg-info">Register
                                                                                                Approve</span>
                                                                                        @endif
                                                                                    </h5>
                                                                                    <h5>
                                                                                        Status Payment : @if ($order->status == 3)
                                                                                            <span
                                                                                                class="badge bg-info text-light">Paid</span>
                                                                                        @else
                                                                                            <span
                                                                                                class="badge bg-warning">Not
                                                                                                Paid</span>
                                                                                        @endif
                                                                                    </h5>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <a href="/course-order/{{ $order->id }}/print" target="__blank"
                                                            class="btn btn-primary"
                                                            onclick="printReceipt({{ $order->id }})">Print</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @canany(['checkout-edit', 'checkout-delete'])
                                            @can('employed-edit')
                                                <a class="btn btn-warning btn-sm" href="#"><i class="bi bi-pencil"></i></a>
                                            @endcan
                                            @csrf
                                            @method('DELETE')
                                            @can('employed-delete')
                                                <button type="submit" class="btn btn-danger btn-sm"><i
                                                        class="bi bi-trash"></i></button>
                                            @endcan
                                        @endcanany
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
