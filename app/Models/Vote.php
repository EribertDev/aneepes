<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    //
    protected $fillable = ['poll_option_id', 'voter_hash'];

    public function option()
    {
        return $this->belongsTo(PollOption::class);
    }
}
