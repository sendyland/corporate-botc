<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title',
        'photo',
        'description',
        'price',
        'url',
        'woo_id',
        'woo_date'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

