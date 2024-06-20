<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_name',
        // 'department_id',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);

    }

    public function Mcq()
    {
        return $this->hasMany(Mcq::class);
    }

    public function McqsBank()
    {
        return $this->hasMany(McqsBank::class);
    }
}
