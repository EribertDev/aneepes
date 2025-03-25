<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Actualite extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'title', 
        'subtitle',
        'description',
        'photo',
        'status',
        'type'
    ];

    protected $casts = [
        'status' => 'string',
        'type' => 'string'
    ];
    protected $dates = ['created_at'];
}
