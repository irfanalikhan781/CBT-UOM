<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class McqsBank extends Model
{
    use HasFactory;
    protected $fillable = [
        'question',
        'option1',
        'option3',
        'option4',
        'option4',
        'answer',
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
