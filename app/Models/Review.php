<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    protected $primaryKey = ['mID', 'id'];
    public $incrementing = false;

    protected $fillable = [
        'mID',
        'id',
        'star',
        'title',
        'content'
    ];

    /**
     * Get the user that owns the Review
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class, 'mID', 'mID');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }
}
