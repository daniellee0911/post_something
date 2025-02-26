<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Comment extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'post_id',
        'user_id',
        'message',
    ];

    protected $hidden = [
        
        'updated_at',
     ];

    protected $casts = [
        
        'created_at' => 'datetime:Y-m-d h:i:s',
    ];

    /**
     * Relationships.
     * 
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
