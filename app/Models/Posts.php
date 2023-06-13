<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posts extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $fillable = [
        'title',
        'content',
        'writer',
        'image',
    ];

        /**
     * Get the writer that owns the posts
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function penulis(): BelongsTo
    {
        return $this->belongsTo(User::class, 'writer', 'id');
    }

    /**
     * Get all of the comments for the Posts
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comments::class, 'post_id', 'id');
    }

        /**
     * Get the reply that owns the Reply
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reply(): HasMany
    {
        return $this->HasMany(Reply::class, 'comment_id', 'id');
    }
    // /**
    //  * Get all of the comments for Hasmany posts
    //  *
    //  * @return \Illuminate\Database\Eloquent\Relations\HasMany
    //  */
    // public function comments(): HasMany
    // {
    //     return $this->hasMany(Comments::class, 'post_id', 'id');
    // }
}
