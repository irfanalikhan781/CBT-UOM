<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    protected $fillable = [
        'candidate_id',
        'candidate_name',
        'candidate_username',
        'department_id',
        'score',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
