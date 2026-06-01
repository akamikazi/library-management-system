<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $primaryKey = 'student_id';

    protected $fillable = [
        'name',
        'class',
    ];

    public function borrows(): HasMany
    {
        return $this->hasMany(Borrow::class, 'student_id', 'student_id');
    }
}
