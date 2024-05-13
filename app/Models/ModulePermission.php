<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModulePermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_name', // Nama modul (misalnya 'Product', 'User', dll.)
        'permission_name', // Nama permission (misalnya 'create', 'edit', 'delete', dll.)
    ];
}
