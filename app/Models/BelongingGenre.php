<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;

class BelongingGenre extends Model
{
    use HasFactory;

    protected $primaryKey = ['mID', 'gID'];
    public $incrementing = false;

    protected $fillable = [
        'mID',
        'gID'
    ];

    /**
     * Get the user that owns the BelongingGenre
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function movies(): BelongsTo
    {
        return $this->belongsTo(Movie::class, 'mID', 'mID');
    }

    public function genres(): BelongsTo
    {
        return $this->belongsTo(Genre::class, 'gID', 'gID');
    }
}
