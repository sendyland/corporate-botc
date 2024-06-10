<?php

namespace App\Http\Controllers;

use App\Models\Employed;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $datauser = auth()->user()->id;
        $data = User::find($datauser);
        $employeds = Employed::where('user_id', $datauser)->count();
        return view('profile.index', compact('data', 'employeds'));
    }

    public function update(Request $request)
    {
        $userId = auth()->user()->id;
        $user = User::findOrFail($userId);

        $user->namepic = $request->input('fullName');
        $user->name = $request->input('company');
        $user->phone = $request->input('phone');
        $user->position = $request->input('position');
        $user->address = $request->input('address');
        // $user->email = $request->input('email');
        // tambahkan field lainnya sesuai kebutuhan

        $user->save();

        return redirect()->route('profile.index')->with('success', 'Profile updated successfully');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $userId = auth()->user()->id;
        $user = User::findOrFail($userId);

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Password lama tidak sesuai.');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('profile.index')->with('success', 'Password berhasil diperbarui.');
    }

}
