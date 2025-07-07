<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\HasMany;

class Genre extends Model
{
    use HasFactory;

    protected $fillable =[
        'genreName'
    ];

    /**
     * Get all of the belongingGenres for the Genre
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function belongingGenres(): HasMany
    {
        return $this->hasMany(BelongingGenre::class, 'gID', 'gID');
    }
}
