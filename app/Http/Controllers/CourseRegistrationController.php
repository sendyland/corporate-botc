<?php

namespace App\Http\Controllers;

use App\Models\CourseRegistration;
use App\Models\CourseRegistrationItem;
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

        return view('courseregister.index', compact('courseregister'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function create(): View
    {
        return view('courseregister.create');
    }
    public function store(Request $request): RedirectResponse
    {
        // Validasi input
        $validatedData = $request->validate([
            'course_id' => 'required',
            'company_name' => 'required',
            'pic_name' => 'required',
            'pic_email' => 'required|email',
            'phone' => 'required',
            'participants' => 'required|integer|min:1',
            'note' => 'nullable',
        ]);

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
            'participants' => $request->input('participants'),
            'kategori' => $request->input('kategori'),
            'user_id' => $user_id
        ];

        $regis = CourseRegistration::create($data);
        $order_id = $regis->id;

        $count_course = count($request->input('course'));
        for ($x = 0; $x < $count_course; $x++) {
            $items = [
                'order_id' => $order_id,
                'employed_id' => $request->input('warna')[$x],
                'course_id' => $request->input('lot')[$x],
                'price' => $request->input('partai')[$x],
            ];

            CourseRegistrationItem::create($items);
        }

        return ($order_id) ? $order_id : false;
    }

}
