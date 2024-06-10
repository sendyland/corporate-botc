<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

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

    public function create(): View
    {
        return view('courses.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'url' => 'required|string|url',
            'woo_id' => 'required|integer',
        ]);

        try {
            // Handle file upload
            if ($request->hasFile('photo')) {
                $fileName = time().'.'.$request->photo->extension();
                $request->photo->move(public_path('uploads/course'), $fileName);
                $photoPath = $fileName;
            } else {
                $photoPath = null; // Atau Anda bisa memberikan nilai default atau penanganan lainnya
            }

            // Create course using explicit assignment
            $course = Course::create([
                'title' => $request->input('title'),
                'photo' => $photoPath,
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

    public function edit(Course $course): View
    {
        return view('courses.edit', compact('course'));
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
