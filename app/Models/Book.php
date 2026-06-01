<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    protected $primaryKey = 'book_id';

    protected $fillable = [
        'title',
        'author',
        'quantity',
    ];

    public function borrows(): HasMany
    {
        return $this->hasMany(Borrow::class, 'book_id', 'book_id');
    }
}
