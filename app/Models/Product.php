<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'description', 'image_link', 'count', 'price'
    ];

    function user() {
        return $this->belongsTo(User::class);
    }

    function category() {
        return $this->belongsTo(Category::class);
    }
}
