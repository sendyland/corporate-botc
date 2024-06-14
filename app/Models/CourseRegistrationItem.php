<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseRegistrationItem extends Model
{
    protected $fillable = ['order_id','employed_id', 'course_id', 'price','enrollment_id'];
    public function employed()
    {
        return $this->belongsTo(Employed::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function courseRegistration()
    {
        return $this->belongsTo(CourseRegistration::class, 'order_id');
    }
}
