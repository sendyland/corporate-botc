<?php

namespace App\Http\Controllers;

use App\Models\Employed;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Contracts\Role;

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
        ]);

        $company_id = Auth::user()->id;
        Employed::create([
            'name' => $request->name,
            'tempat_lahir'=> $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'jk' => $request->jk,
            'telp' => $request->telp,
            'email' => $request->email,
            'status' => 0,
            'status_woo' => 0,
            'position' => $request->position,
            'user_id' => $company_id,
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

        if ($userRoles !== 'Administrator' && $employed->user_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        if ($userRoles->contains('Administrator')) {
            $disable = '';
        } else {
            $disable = 'disabled';
        }

        return view('employeds.edit', compact('employed', 'disable'));
    }

    public function update(Request $request, Employed $employed): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:employeds,email,'.$employed->id,
            'position' => 'required|string',
        ]);

        $employed->update($request->all());

        return redirect()->route('employeds.index')
            ->with('success', 'Employed updated successfully');
    }

    public function destroy(Employed $employed): RedirectResponse
    {
        $employed->delete();

        return redirect()->route('employeds.index')
            ->with('success', 'Employed deleted successfully');
    }
}
