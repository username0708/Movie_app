<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'mName',
        'date',
        'time',
        'image'
    ];

    protected $primaryKey = 'mID';

    /**
     * Get all of the comments for the Movie
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'mID', 'mID');
    }

    /**
     * Get all of the belongingGenres for the Movie
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function belongingGenres(): HasMany
    {
        return $this->hasMany(BelongingGenre::class, 'mID', 'mID');
    }
}
