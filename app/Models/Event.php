<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'lieu',
        'date_heure',
        'statut',
        'type',
        'image'
    ];

    protected $casts = [
        'date_heure' => 'datetime'
    ];

    // Scope pour les événements à venir
    public function scopeUpcoming($query)
    {
        return $query->where('statut', 'a_venir')
                    ->where('date_heure', '>', now());
    }

    // Scope pour les événements terminés
    public function scopePast($query)
    {
        return $query->where('statut', 'termine')
                    ->orWhere('date_heure', '<', now());
    }


public function scopeFeatured($query)
{
    return $query->where('statut', 'a_venir')
                 ->where('date_heure', '>', now());
}
public function getIsPastAttribute()
{
    return $this->date->isPast();
}

public function getDaysRemainingAttribute()
{
    return now()->diffInDays($this->date);
}

}
