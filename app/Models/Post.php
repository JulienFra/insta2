<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    use HasFactory;
    protected $fillable = [
        'body', // Ajoutez d'autres champs si nécessaire
    ];
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
