<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'participants',
        'order_number',
        'noted',
        'status'
    ];

    public function items()
    {
        return $this->hasMany(CourseRegistrationItem::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function generateOrderNumber()
    {
        $prefix = 'CORP-ORDER-';
        $randomNumber = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        return $prefix . $randomNumber;
    }
}
