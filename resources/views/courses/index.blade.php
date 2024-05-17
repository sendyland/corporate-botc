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
        <h1>Courses</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Courses</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    @can('course-create')
        <a class="btn btn-success" href="{{ route('courses.create') }}"> Create Course</a>
    @endcan

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <h5 class="card-title">All Courses</h5>
                    @foreach ($courses as $course)
                        <div class="col-xxl-3 col-md-6">
                            <div class="card">
                                <img src="assets/img/card-course.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title product">{{ $course->title }}</h5>
                                    <p class="card-text">Rp{{ number_format($course->price, 0, ',', '.') }}
                                        <br>
                                    </p>
                                    {{ $course->description }}

                                </div>
                                <form action="{{ route('courses.destroy', $course->id) }}" method="POST">
                                    @can('course-edit')
                                        <a class="btn btn-warning btn-sm" href="{{ route('courses.edit', $course->id) }}"><i
                                                class="bi bi-pencil-square"></i></a>
                                    @endcan

                                    @csrf
                                    @method('DELETE')
                                    @can('course-delete')
                                        <button type="submit" class="btn btn-danger btn-sm"><i
                                                class="bi bi-trash"></i></button>
                                    @endcan
                                </form>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    @endsection
