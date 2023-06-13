<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Likes extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'post_id',
    ];

    /**
    /**
     * Get the commentator that owns the Comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function liker(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
