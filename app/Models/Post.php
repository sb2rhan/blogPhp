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

    public function getRouteKeyName() # returns default keyname of route which is id now
    {
        return parent::getRouteKeyName();
    }
}
