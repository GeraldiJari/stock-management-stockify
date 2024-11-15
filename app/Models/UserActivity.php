<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id', 
        'activity', 
        'description', 
        'target_type', 
        'target_id', 
        'created_at', 
        'updated_at'
    ];

    /**
     * Relasi ke model User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
