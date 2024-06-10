<?php

namespace App\Http\Controllers;

use App\Models\Employed;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Contracts\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EmployedController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:employed-list|employed-create|employed-edit|employed-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:employed-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:employed-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:employed-delete', ['only' => ['destroy']]);
    }

    public function index(): View
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $userRoles = $user->getRoleNames();

        if ($userRoles->contains('Administrator')) {
            $employeds = Employed::latest()->paginate(5);
        } else {
            $employeds = Employed::where('user_id', $user->id)->latest()->paginate(5);
        }

        foreach ($employeds as $employed) {
            $employed->status = $this->checkDataComplete($employed) ? 'Complete' : 'Lengkapi';
            $employed->company = User::where('id', $employed->user_id)->first();
        }
        return view('employeds.index', compact('employeds'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    private function checkDataComplete($employed)
    {
        return $employed->name && $employed->tempat_lahir && $employed->tgl_lahir && $employed->jk && $employed->telp && $employed->email && $employed->position;
    }

    public function create(): View
    {
        return view('employeds.create');
    }

    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:employeds,email',
            'position' => 'required|string',
            'file_ktp' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
            'file_foto' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file_ijazah' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
            'file_cv' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
        ]);

        $company_id = Auth::user()->id;

  // Handle file uploads
  $fileKtp = $request->file('file_ktp') ? $request->file('file_ktp')->store('upload/employed/file_ktp', 'public') : null;
  $fileFoto = $request->file('file_foto') ? $request->file('file_foto')->store('upload/employed/file_foto', 'public') : null;
  $fileIjazah = $request->file('file_ijazah') ? $request->file('file_ijazah')->store('upload/employed/file_ijazah', 'public') : null;
  $fileCv = $request->file('file_cv') ? $request->file('file_cv')->store('upload/employed/file_cv', 'public') : null;
  $fileSeamanbook = $request->file('file_seamanbook') ? $request->file('file_seamanbook')->store('upload/employed/file_seamanbook', 'public') : null;


  Employed::create([
    'name' => $request->name,
    'tempat_lahir' => $request->tempat_lahir,
    'tgl_lahir' => $request->tgl_lahir,
    'jk' => $request->jk,
    'telp' => $request->telp,
    'email' => $request->email,
    'status' => 0,
    'status_woo' => 0,
    'position' => $request->position,
    'user_id' => $company_id,
    'file_ktp' => $fileKtp,
    'file_foto' => $fileFoto,
    'file_ijazah' => $fileIjazah,
    'file_cv' => $fileCv,
    'file_seamanbook' => $fileSeamanbook,
]);

        return redirect()->route('employeds.index')
            ->with('success', 'Employed created successfully.');
    }

    public function show(Employed $employed): View
    {
        return view('employeds.show', compact('employed'));
    }

    public function edit(Employed $employed): View
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $userRoles = $user->getRoleNames();

        // Pastikan perbandingan user_id menggunakan tipe data yang sama
        $employedUserId = (int) $employed->user_id;
        $userId = (int) $user->id;

        if (!$userRoles->contains('Administrator') && $employedUserId !== $userId) {
            Log::warning('Unauthorized action attempted by User ID: ' . $userId);
            abort(403, 'Unauthorized action.');
        }

        $disable = $userRoles->contains('Administrator') ? '' : 'disabled';

        return view('employeds.edit', compact('employed', 'disable'));
    }


    public function update(Request $request, Employed $employed): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:employeds,email,'.$employed->id,
            'position' => 'required|string',
            'file_ktp' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
            'file_foto' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file_ijazah' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
            'file_cv' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
        ]);

        $data = $request->all();

       // Handle file uploads
       if ($request->hasFile('file_ktp')) {
        if ($employed->file_ktp) {
            Storage::disk('public')->delete($employed->file_ktp);
        }
        $data['file_ktp'] = $request->file('file_ktp')->store('upload/employed/file_ktp', 'public');
    }

    if ($request->hasFile('file_foto')) {
        if ($employed->file_foto) {
            Storage::disk('public')->delete($employed->file_foto);
        }
        $data['file_foto'] = $request->file('file_foto')->store('upload/employed/file_foto', 'public');
    }

    if ($request->hasFile('file_ijazah')) {
        if ($employed->file_ijazah) {
            Storage::disk('public')->delete($employed->file_ijazah);
        }
        $data['file_ijazah'] = $request->file('file_ijazah')->store('upload/employed/file_ijazah', 'public');
    }

    if ($request->hasFile('file_cv')) {
        if ($employed->file_cv) {
            Storage::disk('public')->delete($employed->file_cv);
        }
        $data['file_cv'] = $request->file('file_cv')->store('upload/employed/file_cv', 'public');
    }

    if ($request->hasFile('file_seamanbook')) {
        if ($employed->file_seamanbook) {
            Storage::disk('public')->delete($employed->file_seamanbook);
        }
        $data['file_seamanbook'] = $request->file('file_seamanbook')->store('upload/employed/file_seamanbook', 'public');
    }

    $employed->update($data);

    return redirect()->route('employeds.index')
        ->with('success', 'Employed updated successfully');
}

public function destroy(Employed $employed): RedirectResponse
{
    // Hapus file yang terkait
    if ($employed->file_ktp) {
        Storage::disk('public')->delete($employed->file_ktp);
    }
    if ($employed->file_foto) {
        Storage::disk('public')->delete($employed->file_foto);
    }
    if ($employed->file_ijazah) {
        Storage::disk('public')->delete($employed->file_ijazah);
    }
    if ($employed->file_cv) {
        Storage::disk('public')->delete($employed->file_cv);
    }
    if ($employed->file_seamanbook) {
        Storage::disk('public')->delete($employed->file_seamanbook);
    }

    // Hapus entitas Employed
    $employed->delete();

    return redirect()->route('employeds.index')
        ->with('success', 'Employed deleted successfully');
}
}
