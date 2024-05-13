<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employed extends Model
{
    protected $fillable = ['name', 'email', 'position', 'user_id']; // Menyesuaikan fillable

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

