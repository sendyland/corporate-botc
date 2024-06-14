<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employed extends Model
{
    protected $fillable = ['name','tempat_lahir','tgl_lahir','jk','telp', 'email', 'position','status','status_woo', 'user_id', 'file_ktp', 'file_foto', 'file_ijazah', 'file_cv','file_seamanbook','wp_id']; // Menyesuaikan fillable

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

