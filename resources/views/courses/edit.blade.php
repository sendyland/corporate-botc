@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Edit Course</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Courses</li>
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
    <div class="col-12 mt-2">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Course</h5>
                <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Title</strong>
                                <input type="text" name="title" value="{{ $course->title }}" class="form-control"
                                    placeholder="Title">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Price</strong>
                                <input type="text" name="price" value="{{ $course->price }}" class="form-control"
                                    placeholder="Price">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Description</strong>
                                <textarea class="form-control" style="height:150px" name="description" placeholder="Description">{{ $course->description }}</textarea>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Reference Url Learning</strong>
                                <input type="text" name="url" value="{{ $course->url }}" class="form-control"
                                    placeholder="https://">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Woo ID</strong>
                                <input type="text" name="woo_id" id="woo_id" class="form-control"
                                    value="{{ $course->woo_id }}">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Photo</strong>
                                <input type="file" name="photo" class="form-control">
                                @if ($course->photo)
                                    <img src="{{ asset('uploads/course/' . $course->photo) }}" alt="Course Photo"
                                        class="img-fluid mt-2">
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
