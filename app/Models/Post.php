<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Comment;
use App\Models\Rating;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    //
    protected $fillable = ['title', 'slug', 'content', 'image', 'editor_id', 'tags', 'publication_date','status','category'];   

    protected $casts = [
        'tags' => 'array',
        'publication_date' => 'datetime'
    ];

    public function editor()
    {
        return $this->belongsTo(User::class, 'editor_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopePublished($query)
{
    return $query->where('status', 'published')
               ->where('publication_date', '<=', now());
}

public function comments():HasMany
{
    return $this->hasMany(Comment::class);
}

public function ratings():HasMany
{
    return $this->hasMany(Rating::class);
}

    // Accesseur pour la moyenne des notes
    public function getAverageRatingAttribute()
    {
        return $this->ratings()->avg('value') ?? 0;
    }

    // Accesseur pour le nombre de votes
    public function getRatingsCountAttribute()
    {
        return $this->ratings()->count();
    }

}
