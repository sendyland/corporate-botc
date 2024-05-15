<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseRegistration;
use App\Models\CourseRegistrationItem;
use App\Models\Employed;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CourseRegistrationController extends Controller
{

    public function index(): View
    {
        $user = Auth::user();
        $role = $user->role; // Anda perlu mengganti 'role' dengan atribut yang benar dari model User yang menyimpan peran pengguna

        if ($role === 'Admin') {
            $courseregister = CourseRegistration::latest()->paginate(5);
        } else {
            $courseregister = CourseRegistration::where('user_id', $user->id)->latest()->paginate(5);
        }

        foreach ($courseregister as $order) {

            $order->items = CourseRegistrationItem::where('order_id', $order->id)->latest()->get();

            $order->participantCount = CourseRegistrationItem::where('order_id', $order->id)->count();
            $order->totalPrice = CourseRegistrationItem::where('order_id', $order->id)->sum('price');
            $order->company = User::where('id', $order->user_id)->first();
        }

        return view('courseregister.index', compact('courseregister'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

        public function create(): View
        {
            $user = Auth::user();
            $role = $user->role;
            $allcourses = Course::all();
            if ($role === 'Admin') {
                $employeds = Employed::latest()->paginate(5);
            } else {
                $employeds = Employed::where('user_id', $user->id)->latest()->paginate(5);
            }

            return view('courseregister.create',compact('allcourses', 'employeds'));
        }

    public function store(Request $request): RedirectResponse
    {
        // Tambahkan user_id
        $validatedData['user_id'] = Auth::id();

        // Generate random order number
        $validatedData['order_number'] = CourseRegistration::generateOrderNumber();

        // Simpan pendaftaran kursus ke dalam database
        CourseRegistration::create($validatedData);

        // Redirect atau kirim respon sukses
        return redirect()->back()->with('success', 'Pendaftaran berhasil!');
    }

    public function createWithItem(Request $request): RedirectResponse
    {
        $user_id = Auth::id();
        $data = [
            'order_number' => CourseRegistration::generateOrderNumber(),
            'participants' => 0,
            'kategori' => $request->input('kategori'),
            'user_id' => $user_id
        ];

        $regis = CourseRegistration::create($data);
        $order_id = $regis->id;

        $count_course = count($request->input('program'));
        for ($x = 0; $x < $count_course; $x++) {
            $items = [
                'order_id' => $order_id,
                'employed_id' => $request->input('name')[$x],
                'course_id' => $request->input('program')[$x],
                'price' => $request->input('price')[$x],
            ];

            CourseRegistrationItem::create($items);
        }

        return redirect()->route('course-order.index')
        ->with('success', 'Employed created successfully.');
    }

}
