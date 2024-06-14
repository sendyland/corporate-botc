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
            flex-direction: column;
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
        <h1>Courses</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Courses</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    @can('course-create')
        <a class="btn btn-success" id="createCourseBtn" href="{{ route('courses.create') }}">Create Course</a>
    @endcan
    <!-- Loading Overlay -->
    <div id="loading" class="loading-overlay">
        <div class="loading-spinner"></div>
        <div class="loading-text">Loading Data Course</div>
    </div>

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
                                <a href="{{ $course->url }}" target="__blank">
                                    @if ($course->photo)
                                        <img src="{{ $course->photo }}" alt="Photo" class="card-img-top">
                                    @else
                                        <img src="assets/img/card-course.jpg" class="card-img-top" alt="...">
                                    @endif

                                </a>
                                <div class="card-body">
                                    <a href="{{ $course->url }}" target="__blank">
                                        <h5 class="card-title product">{{ $course->title }}</h5>
                                    </a>
                                    <p class="card-text">Rp{{ number_format($course->price, 0, ',', '.') }}
                                        <br>
                                    </p>
                                    {{ $course->description }}

                                </div>
                                <form id="delete-form-{{ $course->id }}"
                                    action="{{ route('courses.destroy', $course->id) }}" method="POST">
                                    @can('course-edit')
                                        <a class="btn btn-warning btn-sm" href="{{ route('courses.edit', $course->id) }}"><i
                                                class="bi bi-pencil-square"></i></a>
                                    @endcan

                                    @csrf
                                    @method('DELETE')
                                    @can('course-delete')
                                        <button type="button" class="btn btn-danger btn-sm delete-course"
                                            data-course-id="{{ $course->id }}"><i class="bi bi-trash"></i></button>
                                    @endcan
                                </form>


                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    @endsection
    @section('myscript')
        <script>
            // Add event listener when the document is ready
            document.addEventListener('DOMContentLoaded', function() {
                // Get all delete buttons with class 'delete-course'
                const deleteButtons = document.querySelectorAll('.delete-course');

                // Iterate over each delete button
                deleteButtons.forEach(button => {
                    // Add click event listener to each delete button
                    button.addEventListener('click', function() {
                        // Get the course ID from the data attribute
                        const courseId = this.getAttribute('data-course-id');

                        // Display the confirmation modal
                        Swal.fire({
                            title: 'Are you sure?',
                            text: 'You won\'t be able to revert this!',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            // If the user confirms deletion, submit the form
                            if (result.isConfirmed) {
                                document.getElementById('delete-form-' + courseId).submit();
                            }
                        });
                    });
                });
            });
        </script>
        <script>
            document.getElementById('createCourseBtn').addEventListener('click', function(event) {
                document.getElementById('loading').style.display = 'flex';
            });
        </script>
    @endsection
