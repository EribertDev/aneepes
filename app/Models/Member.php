<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'fullname', 
        'email', 
        'phone', 
        'role', 
        'photo',
        'is_visible'
    ];

    public function getPhotoUrlAttribute()
    {
        return $this->photo 
            ? asset('storage/members/' . $this->photo)
            : asset('assets/images/team-default.jpg');
    }
}