<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class PollOption extends Model
{
    //
    protected $fillable = ['text'];

    public function poll()
    {
        return $this->belongsTo(Polls::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function getPercentageAttribute()
    {
        $total = $this->poll->total_votes;
        return $total > 0 ? round(($this->votes->count() / $total) * 100, 2) : 0;
    }
}
