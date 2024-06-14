<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Client;

class CourseController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:course-list|course-create|course-edit|course-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:course-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:course-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:course-delete', ['only' => ['destroy']]);
    }

    public function index(): View
    {
        $courses = Course::all();
        return view('courses.index', compact('courses'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $cacheKey = 'courses_data';
        if (Cache::has($cacheKey)) {
            $courses = Cache::get($cacheKey);
        } else {
            // Jika tidak ada di cache, panggil API dan simpan ke cache
            $client = new Client();
            $courses = [];
            $page = 1;
            $totalPages = 1;

            try {
                while ($page <= $totalPages) {
                    $response = $client->get(env('TUTORLMS_URL') . '/courses', [
                        'auth' => [env('TUTORLMS_CONSUMER_KEY'), env('TUTORLMS_CONSUMER_SECRET')],
                        'query' => [
                            'paged' => $page,
                        ],
                    ]);
                    $responseData = json_decode($response->getBody()->getContents(), true);

                    if ($page === 1) {
                        $totalPages = $responseData['data']['total_page'];
                    }

                    $courses = array_merge($courses, $responseData['data']['posts']);
                    $page++;
                }

                // Simpan data ke cache dengan waktu expired (misalnya 1 jam)
                Cache::put($cacheKey, $courses, 60 * 60); // 1 jam

            } catch (\Exception $e) {
                // Handle error
                return redirect()->back()->withErrors('Failed to fetch courses from Tutor LMS: ' . $e->getMessage());
            }
        }

        return view('courses.create', ['courses' => $courses]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string',
            'photo' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'url' => 'required|string|url',
            'woo_id' => 'required|integer',
        ]);

        try {

            // Create course using explicit assignment
            $course = Course::create([
                'title' => $request->input('title'),
                'photo' => $request->input('photo'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'url' => $request->input('url'),
                'woo_id' => $request->input('woo_id'),
            ]);

            return redirect()->route('courses.index')
                ->with('success', 'Course created successfully.');
        } catch (\Exception $e) {
            // Log error
            Log::error('Error creating course: ' . $e->getMessage(), [
                'request_data' => $request->all(),
                'exception' => $e,
            ]);

            return redirect()->route('courses.index')
                ->with('error', 'Error creating course: ' . $e->getMessage());
        }
    }


    public function show(Course $course): View
    {
        return view('courses.show', compact('course'));
    }
    public function edit(Course $course)
    {
        // Key untuk menyimpan data kursus di cache
        $cacheKey = 'course_' . $course->id;

        try {
            if (Cache::has($cacheKey)) {
                $cachedCourses = Cache::get($cacheKey);
            } else {
                // Data kursus tidak ditemukan di cache, ambil dari API
                $client = new Client();
                $courses = [];
                $page = 1;
                $totalPages = 1;
                while ($page <= $totalPages) {
                    $response = $client->get(env('TUTORLMS_URL') . '/courses', [
                        'auth' => [env('TUTORLMS_CONSUMER_KEY'), env('TUTORLMS_CONSUMER_SECRET')],
                        'query' => [
                            'paged' => $page,
                        ],
                    ]);
                    $responseData = json_decode($response->getBody()->getContents(), true);
                    if ($page === 1) {
                        $totalPages = $responseData['data']['total_page'];
                    }
                    $courses = array_merge($courses, $responseData['data']['posts']);
                    $page++;
                }

                // Simpan data kursus ke cache dengan waktu kadaluarsa 60 menit (opsional)
                Cache::put($cacheKey, $courses, now()->addMinutes(60));

                $cachedCourses = $courses; // Assign cached data to variable
            }

            // Kirim data course yang diedit dan data kursus untuk dropdown select ke blade template
            return view('courses.edit', compact('course', 'cachedCourses'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Failed to fetch courses from WordPress: ' . $e->getMessage());
        }
    }


    public function update(Request $request, Course $course): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric',
            'url' => 'required|string|url',
        ]);

        try {
            // Handle file upload
            if ($request->hasFile('photo')) {
                $fileName = time().'.'.$request->photo->extension();
                $request->photo->move(public_path('uploads/course'), $fileName);
                $photoPath = $fileName;
            } else {
                $photoPath = $course->photo; // Jika tidak ada file baru diunggah, gunakan foto yang sudah ada
            }

            $course->update([
                'title' => $request->input('title'),
                'photo' => $photoPath,
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'url' => $request->input('url'),
                'woo_id' => $request->input('woo_id'),
            ]);

            return redirect()->route('courses.index')
                ->with('success', 'Course updated successfully');
        } catch (\Exception $e) {
            // Log error
            Log::error('Error updating course: ' . $e->getMessage(), [
                'request_data' => $request->all(),
                'exception' => $e,
            ]);

            return redirect()->route('courses.index')
                ->with('error', 'Error updating course: ' . $e->getMessage());
        }
    }

    public function destroy(Course $course): RedirectResponse
    {
        try {
            $course->delete();
            return redirect()->route('courses.index')
                ->with('success', 'Course deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('courses.index')
                ->with('error', 'Error deleting course: ' . $e->getMessage());
        }
    }
}
