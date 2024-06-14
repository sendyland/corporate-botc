<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseRegistration;
use App\Models\CourseRegistrationItem;
use App\Models\Employed;
use App\Models\User;
use App\Services\WooCommerceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Mail\CourseRegistrationApproved;
use App\Mail\ParticipantRegistered;
use Illuminate\Support\Facades\Mail;

class CourseRegistrationController extends Controller
{

    // function __construct()
    // {
    //     $this->middleware('permission:employed-delete', ['only' => ['destroy']]);
    // }

    public function index(): View
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $userRoles = $user->getRoleNames();

         if ($userRoles->contains('Administrator')) {
            $courseregister = CourseRegistration::latest()->paginate(5);
        } else {
            $courseregister = CourseRegistration::where('user_id', $user->id)->latest()->paginate(5);
        }
        // Eager load related models to reduce the number of queries
        $courseregister->load(['items', 'user']);

    foreach ($courseregister as $order) {
        $order->items = $order->items->sortByDesc('created_at');
        $order->employed = Employed::find($order->items->pluck('employed_id'));
        $order->participantCount = $order->items->count();
        $order->totalPrice = formatRupiah($order->items->sum('price'));
        $order->company = $order->user;
    }

    return view('courseregister.index', compact('courseregister'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
}

    public function show(CourseRegistration $courseregistration): View
    {
        $orderitem = CourseRegistrationItem::where('order_id', $courseregistration->id)->get();
        return view('courseregister.show', compact('courseregistration'));
    }

    public function create(): View
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $userRoles = $user->getRoleNames();

        // Mengambil ID employed yang sudah terdaftar di CourseRegistrationItem yang statusnya belum dibayar di CourseRegistration
        $employedIdsWithUnpaidStatus = CourseRegistrationItem::whereHas('courseRegistration', function ($query) {
            $query->where('status', 0);
        })->pluck('employed_id');

        // Memfilter employed yang tidak ada di daftar employedIdsWithUnpaidStatus
        if ($userRoles->contains('Administrator')) {
            $employeds = Employed::whereNotNull('wp_id')
                                 ->whereNotIn('id', $employedIdsWithUnpaidStatus)->latest()->paginate(5);
        } else {
            $employeds = Employed::whereNotNull('wp_id')
                                 ->where('user_id', $user->id)
                                 ->whereNotIn('id', $employedIdsWithUnpaidStatus)
                                 ->latest()
                                 ->paginate(5);
        }

        // Mengambil kursus yang memiliki woo_id yang tidak kosong
        $allcourses = Course::whereNotNull('woo_id')
                            ->where('woo_id', '!=', '')
                            ->get();

        return view('courseregister.create', compact('allcourses', 'employeds'));
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
            'noted' => $request->input('noted'),
            'status' => 0,
            'status_payment' => 0,
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

    public function print($id)
    {
        $order = CourseRegistration::findOrFail($id);
        return view('courseregister.print', compact('order'));
    }

    public function edit($id)
    {
        // Find the course registration by the given ID
        $courseRegistration = CourseRegistration::with(['items', 'user'])->findOrFail($id);

        // Adjust items data
        $courseRegistration->items->transform(function ($item, $key) {
            $item->employed = Employed::find($item->employed_id);
            return $item;
        });

        // Calculate additional details
        $participantCount = $courseRegistration->items->count();
        $totalPrice = $courseRegistration->items->sum('price');

        return view('courseregister.edit', compact('courseRegistration', 'participantCount', 'totalPrice'));
    }
    public function update(Request $request, $id): RedirectResponse
    {
        // Validate the request input
        $request->validate([
            'status' => 'nullable|string|max:255',
        ]);

        // Find the course registration by the given ID
        $courseRegistration = CourseRegistration::findOrFail($id);
        $courseRegistration->status = $request->input('status');

        if ($request->status == 1) {
            $status_payment = 0;
        } else {
            $status_payment = 0;
        }

        // Update the course registration with the new values
        $courseRegistration->update([
            'user_id_approve' => Auth::user()->id,
            'approve_at' => Carbon::now(),
            'status' => $request->status,
            'status_payment' => $status_payment
        ]);
        if ($request->status == 1) {
             // Get all course registration items associated with the order_id
        $items = CourseRegistrationItem::where('order_id', $id)->get();
        if ($request->input('status') == 1) {
            // Mengirim email persetujuan ke perusahaan
            Mail::to($courseRegistration->user->email)->send(new CourseRegistrationApproved($courseRegistration));

            // Mengirim email ke setiap peserta
            foreach ($courseRegistration->items as $item) {
                Mail::to($item->employed->email)->send(new ParticipantRegistered($item->employed, $item->course));
            }
        }
        // Array to collect enrollment_ids
        $enrollmentIds = [];

        // Loop through each item to update enrollment_id
        foreach ($items as $index => $item) {
            // Fetch enrollment_id from external API
            $enrollmentId = $this->fetchEnrollmentIdFromExternalAPI($item);
            $item->update(['enrollment_id' => $enrollmentId]);
            $enrollmentIds[] = $enrollmentId;
        }

        return redirect()->route('course-order.index')
            ->with('success', 'Course registration updated successfully.');
        }
        return redirect()->route('course-order.index')
        ->with('success', 'Course registration updated successfully.');
    }

// Function to fetch enrollment_id from an external API
private function fetchEnrollmentIdFromExternalAPI($item)
{
    $client = new Client();

    try {
        $response = $client->post(env('TUTORLMS_URL') . '/enrollments', [
            'auth' => [env('TUTORLMS_CONSUMER_KEY'), env('TUTORLMS_CONSUMER_SECRET')],
            'json' => [
                'user_id' => $item->employed_id,
                'course_id' => $item->course_id,
            ],
        ]);
        $data = json_decode($response->getBody(), true);
        $enrollmentId = $data['data']['enrollment_id'];

        return $enrollmentId;
    } catch (\Exception $e) {
        Log::error('Error creating enrollment: ' . $e->getMessage());
        return null;
    }
}

public function payment($id):View
{
    // Find the course registration by the given ID
    $courseRegistration = CourseRegistration::with(['items', 'user'])->findOrFail($id);

    // Adjust items data
    $courseRegistration->items->transform(function ($item, $key) {
        $item->employed = Employed::find($item->employed_id);
        return $item;
    });

    // Calculate additional details
    $participantCount = $courseRegistration->items->count();
    $totalPrice = $courseRegistration->items->sum('price');

    return view('courseregister.payment', compact('courseRegistration', 'participantCount', 'totalPrice'));
}

public function update_payment(Request $request, $id): RedirectResponse
{
    // Validate the request input
    $request->validate([
        'status' => 'nullable|string|max:255',
    ]);

    // Find the course registration by the given ID
    $courseRegistration = CourseRegistration::findOrFail($id);
    $courseRegistration->update([
        'user_id_payment' => Auth::user()->id,
        'payment_at' => Carbon::now(),
        'status_payment' => $request->status,
    ]);

    return redirect()->route('course-order.index')
    ->with('success', 'Course Registration Paymemt Updated.');
}


    public function destroy(CourseRegistration $courseRegistration): RedirectResponse
    {
        $courseRegistration->items()->delete();
        $courseRegistration->delete();
        dd($courseRegistration);
        return redirect()->route('course-order.index')
                         ->with('success', 'Course registration deleted successfully.');
    }
}
