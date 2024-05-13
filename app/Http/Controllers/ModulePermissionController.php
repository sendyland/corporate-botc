<?php

namespace App\Http\Controllers;

use App\Models\ModulePermission;
use Illuminate\Http\Request;

class ModulePermissionController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'module_name' => 'required',
            'permission_name' => 'required',
        ]);

        // Simpan data permission untuk modul
        ModulePermission::create($validatedData);

        // Redirect atau kirim respon sukses
        return redirect()->back()->with('success', 'Permission berhasil dipilih untuk modul!');
    }
}
