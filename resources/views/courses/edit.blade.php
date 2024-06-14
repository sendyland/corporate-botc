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
                        <div class="col-xs-12 col-sm-12">
                            <div class="form-group">
                                <strong>Course Referensi</strong>
                                <select id="course_id" name="woo_id" class="form-control">
                                    <option value="">Pilih Course ID</option>
                                    @foreach ($cachedCourses as $crs)
                                        <option value="{{ $crs['ID'] }}"
                                            @if ($crs['ID'] == $course->woo_id) selected @endif
                                            data-post-name="{{ $crs['post_name'] }}"
                                            data-thumbnail-url="{{ $crs['thumbnail_url'] }}">
                                            {{ $crs['post_title'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12">
                            <div class="form-group">
                                <strong>Judul Course</strong>
                                <input id="judul_course" type="text" name="title" value="{{ $course->title }}"
                                    class="form-control" placeholder="Title">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12">
                            <div class="form-group">
                                <strong>Harga</strong>
                                <input type="text" name="price" value="{{ $course->price }}" class="form-control"
                                    placeholder="Price">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12">
                            <div class="form-group">
                                <strong>Deskripsi</strong>
                                <textarea class="form-control" style="height:150px" name="description" placeholder="Description">{{ $course->description }}</textarea>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12">
                            <div class="form-group">
                                <strong>Referensi Url Learning</strong>
                                <input id="url_learning" type="text" name="url" value="{{ $course->url }}"
                                    class="form-control"
                                    placeholder="https://learning.blueocean-tc.com/courses/{{ $course->post_name }}">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12">
                            <div class="form-group">
                                <strong>Photo</strong>
                                <input id="photo" type="text" name="photo" value="{{ $course->thumbnail_url }}"
                                    class="form-control" readonly>
                                <img id="thumbnail_preview" src="{{ $course->thumbnail_url }}" alt="Thumbnail Preview"
                                    style="max-width: 10%; height: auto; margin-top: 10px;">
                            </div>
                        </div>
                        <div class="col-xs-12 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // JavaScript untuk menampilkan preview gambar dan mengisi URL Learning berdasarkan data course yang dipilih
        document.addEventListener('DOMContentLoaded', function() {
            const judulCourseInput = document.getElementById('judul_course');
            const urlLearningInput = document.getElementById('url_learning');
            const photoInput = document.getElementById('photo');
            const thumbnailPreview = document.getElementById('thumbnail_preview');
            const courseIdSelect = document.getElementById('course_id');

            // Fungsi untuk menyesuaikan data course saat halaman dimuat
            function adjustCourseData() {
                const selectedOption = courseIdSelect.options[courseIdSelect.selectedIndex];
                const postName = selectedOption.getAttribute('data-post-name');
                const postTitle = selectedOption.textContent;
                const thumbnailUrl = selectedOption.getAttribute('data-thumbnail-url');

                judulCourseInput.value = postTitle;
                urlLearningInput.value = `https://learning.blueocean-tc.com/courses/${postName}`;
                photoInput.value = thumbnailUrl;
                thumbnailPreview.src = thumbnailUrl;
                thumbnailPreview.style.display = 'block';
            }

            // Panggil fungsi adjustCourseData saat halaman dimuat
            adjustCourseData();

            // Tambahkan event listener untuk perubahan pada select element
            courseIdSelect.addEventListener('change', function() {
                adjustCourseData();
            });
        });
    </script>
@endsection
