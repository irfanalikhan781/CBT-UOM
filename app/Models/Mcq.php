<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mcq extends Model
{
    use HasFactory;
    protected $fillable = [
        'question',
        'answer',
        'options',
        'explanation',
        'course_id',
        'department_id'

    ];

    public function courses()
    {
        return $this->belongsTo(Course::class);
    }
    public function departments()
    {
        return $this->belongsTo(Department::class);
    }
}
