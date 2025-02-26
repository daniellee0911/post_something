<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Post extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'title',
        'content',
       
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
    
}
