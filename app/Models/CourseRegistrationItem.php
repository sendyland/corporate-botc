<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseRegistrationItem extends Model
{
    protected $fillable = ['employed_id', 'course_id', 'price'];
    public function employed()
    {
        return $this->belongsTo(Employed::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
