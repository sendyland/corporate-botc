@extends('layouts.print')
@section('content')
    <div class="row">
        <div
            class="receipt-main receipt-main-{{ $order->id }} col-xs-12 col-sm-12 col-md-12 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
            <div class="row">
                <div class="col-6">
                    <div class="receipt-header">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="receipt-left">
                                <img class="img-responsive" alt="iamgurdeeposahan"
                                    src="https://bootdey.com/img/Content/avatar/avatar6.png"
                                    style="width: 71px; border-radius: 43px;">
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 text-right mt-2">
                            <div class="receipt-right">
                                <h5>{{ $order->name }}
                                </h5>
                                <p>Telp :
                                    {{ $order->telp }} <i class="fa fa-phone"></i></p>
                                <p>Email :
                                    {{ $order->email }} <i class="fa fa-envelope-o"></i>
                                </p>
                                <p>Alamat :
                                    {{ $order->address }}
                                    <i class="fa fa-location-arrow"></i>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="receipt-header">
                        <div class="col-xs-8 col-sm-8 col-md-8 text-left">
                            <div class="receipt-right">
                                <h5>PIC :
                                    {{ $order->namepic }}
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
                <div class="receipt-header receipt-header-mid receipt-footer">
                    <div class="col-xs-8 col-sm-8 col-md-8 text-left">
                        <div class="receipt-right">
                            <p><b>Date :</b>
                                {{ $order->created_at }}</p>

                            <h5>

                                Status Register : @if ($order->status == 0)
                                    <span class="badge bg-warning">Register
                                        Pending</span>
                                @else
                                    <span class="badge bg-info">Register
                                        Approve</span>
                                @endif
                            </h5>
                            <h5>
                                Status Payment : @if ($order->status == 3)
                                    <span class="badge bg-info text-light">Paid</span>
                                @else
                                    <span class="badge bg-warning">Not
                                        Paid</span>
                                @endif
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
