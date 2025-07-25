<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    //

    protected $fillable = ['value', 'identifier'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
