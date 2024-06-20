<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Program extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function Departments(): BelongsToMany
    {
        return $this->belongsToMany(Department::class, 'department_program');
    }

}
