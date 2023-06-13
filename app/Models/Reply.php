<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reply extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'user_id',
        'comment_id',
        'reply_content',
    ];
        

    

    /**
     * Get the reply that owns the Reply
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    // public function reply(): BelongsTo
    // {
    //     return $this->belongsTo(User::class, 'user_id', 'id');
    // }

}
