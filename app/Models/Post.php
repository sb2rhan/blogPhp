<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    # which columns of table can be filled manually
    protected $fillable = [
        'title', 'content'
    ];
    # getTable function will find table that is 'posts' itself

    # getRouteKeyName returns default keyname of route which is id now

    function user() {
        # Many to 1 relation
        return $this->belongsTo(User::class);
    }
}
