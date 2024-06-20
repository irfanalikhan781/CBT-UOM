<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function Programs(): BelongsToMany
    {
        return $this->belongsToMany(Program::class, 'department_program');

    }

    public function Courses()
    {
        return $this->hasMany(Course::class);
    }

    public function McqsBank()
    {
        return $this->hasMany(McqsBank::class);
    }
}
