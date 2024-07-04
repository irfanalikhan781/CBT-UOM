<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'department_id',
        'total_mcqs',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function mcqs()
    {
        return $this->belongsToMany(McqsBank::class, 'test_mcqs', 'test_id', 'mcq_id')->withTimestamps();
    }
}
