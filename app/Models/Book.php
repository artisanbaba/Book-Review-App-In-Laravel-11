<?php

namespace App\Models;

use App\Models\Review;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'title',
        'author',
        'description',
        'image',
        'status',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
