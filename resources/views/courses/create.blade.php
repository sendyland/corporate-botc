@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Create Course</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Courses</li>
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

    <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12">
                <div class="form-group">
                    <strong>Course Referensi</strong>
                    <select id="course_id" name="woo_id" class="form-control">
                        <option value="">Pilih Course ID</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course['ID'] }}" data-postname="{{ $course['post_name'] }}"
                                data-thumbnail="{{ $course['thumbnail_url'] }}">{{ $course['post_title'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12">
                <div class="form-group">
                    <strong>Judul Course</strong>
                    <input id="judul_course" type="text" name="title" class="form-control" placeholder="Title"
                        value="{{ old('title') }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12">
                <div class="form-group">
                    <strong>Harga</strong>
                    <input type="text" name="price" class="form-control" placeholder="Price"
                        value="{{ old('price') }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12">
                <div class="form-group">
                    <strong>Deskripsi</strong>
                    <textarea class="form-control" style="height:150px" name="description" placeholder="Description">{{ old('description') }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12">
                <div class="form-group">
                    <strong>Foto</strong>
                    <input id="photo" type="text" name="photo" class="form-control" value="{{ old('photo') }}"
                        readonly>
                </div>
                <img id="thumbnail_preview" src="" alt="Thumbnail Preview"
                    style="max-width: 10%; height: auto; display: none;">
            </div>
            <div class="col-xs-12 col-sm-12">
                <div class="form-group">
                    <strong>Referensi Url Learning</strong>
                    <input id="url_learning" type="text" name="url" class="form-control"
                        placeholder="https://learning.blueocean-tc.com/courses/" value="{{ old('url') }}">
                </div>
            </div>
            <div class="col-xs-12 text-center mt-2">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>

    <script>
        // JavaScript untuk mengatur nilai URL Learning, Judul Course, dan Foto berdasarkan pilihan course
        document.addEventListener('DOMContentLoaded', function() {
            const courseSelect = document.getElementById('course_id');
            const judulCourseInput = document.getElementById('judul_course');
            const urlLearningInput = document.getElementById('url_learning');
            const photoInput = document.getElementById('photo');
            const thumbnailPreview = document.getElementById('thumbnail_preview');

            courseSelect.addEventListener('change', function() {
                const selectedOption = courseSelect.options[courseSelect.selectedIndex];
                const postName = selectedOption.getAttribute('data-postname');
                const postTitle = selectedOption.textContent;
                const thumbnailUrl = selectedOption.getAttribute('data-thumbnail');

                if (postName) {
                    judulCourseInput.value = postTitle;
                    urlLearningInput.value = `https://learning.blueocean-tc.com/courses/${postName}`;
                    photoInput.value = thumbnailUrl ? thumbnailUrl : '';
                    thumbnailPreview.src = thumbnailUrl ? thumbnailUrl : '';
                    thumbnailPreview.style.display = thumbnailUrl ? 'block' : 'none';
                } else {
                    judulCourseInput.value = '';
                    urlLearningInput.value = '';
                    photoInput.value = '';
                    thumbnailPreview.src = '';
                    thumbnailPreview.style.display = 'none';
                }
            });
        });
    </script>
@endsection
