<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username', 'mail', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function followings()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'followed_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'following_id');
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'followed_id');
    }

    public function isFollowing(User $user)
    {
        return $this->following->contains($user);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
