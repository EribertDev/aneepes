<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;



class Polls extends Model
{
    //
        use HasFactory;

    protected $fillable = ['question', 'status', 'end_at', 'is_public'];

    protected $casts = [
        'end_at' => 'datetime',
    ];
    public function options(): HasMany
    {
        return $this->hasMany(PollOption::class,'poll_id');
    }

    public function votes()
    {
        
    
        return $this->hasManyThrough(Vote::class, PollOption::class,'poll_id');
    }

    public function getTotalVotesAttribute()
    {
        return $this->votes()->count();
    }

    public function isActive()
    {
        return $this->status === 'active' && ($this->end_at === null || $this->end_at > now());
    }

    public function hasVoted(?string $votedPollsCookie): bool
    {
        // Si aucune valeur n'est fournie, on considère que l'utilisateur n'a pas voté.
        if (is_null($votedPollsCookie)) {
            return false;
        }
        $votedPolls = json_decode($votedPollsCookie, true) ?? [];
        return in_array($this->id, $votedPolls);
    }
    
}
