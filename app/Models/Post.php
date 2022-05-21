<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    // ******
    //  Objects that are mass assignable
    // ******
    protected $fillable = [
        'body',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function likedBy(User $user){
        return $this->likes->contains('user_id', $user->id); //contains is a method of Laravel Collections
    }
}
