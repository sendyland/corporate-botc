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
    </style>
@endsection

@section('content')
    <div class="pagetitle">
        <h1>Order Course</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Order Courses</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <a class="btn btn-success" href="{{ route('course-order.create') }}"> Create Course</a>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="col-12 mt-2">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">All Courses</h5>
                <table class="table table-bordered mt-2">
                    <tr>
                        <th>No</th>
                        <th>No Order</th>
                        <th>Company</th>
                        <th>PIC Name</th>
                        <th>Participant</th>
                        <th>Total Harga</th>
                        <th>Status Order</th>
                        <th width="280px">Action</th>
                    </tr>
                    @foreach ($courseregister as $order)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <th>{{ $order->order_number }}</th>
                            <td>{{ $order->company->name }}</td>
                            <td>{{ $order->company->namepic }}</td>
                            <td>{{ $order->participantCount }}</td>
                            <td>{{ $order->totalPrice }}</td>
                            <td>
                                @if ($order->status == 0)
                                    <span class="badge bg-warning text-dark">Register Pending</span>
                                @else
                                    <span class="badge bg-info text-dark">Register Approve</span>
                                @endif
                            </td>
                            {{-- <td>{{ $employed->user->name }}</td> --}}

                            <td>
                                <button class="btn btn-primary btn-sm">View</button>
                                @canany(['checkout-edit', 'checkout-delete'])
                                    <form action="{{ route('employeds.destroy', $employed->id) }}" method="POST">
                                        @can('employed-edit')
                                            <a class="btn btn-primary" href="{{ route('employeds.edit', $employed->id) }}">Edit</a>
                                        @endcan

                                        @csrf
                                        @method('DELETE')
                                        @can('employed-delete')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        @endcan
                                    </form>
                                @endcanany
                            </td>

                        </tr>
                    @endforeach
                </table>

            </div>
        </div>
    </div>
@endsection
