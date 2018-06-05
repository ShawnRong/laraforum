<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

trait Favoritable
{

    public function favorite($userId)
    {
        $attributes = ['user_id' => $userId];
        if (!$this->favorites()->where($attributes)->exists()) {
            $this->favorites()->create($attributes);
        }
    }

    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }

    public function getFavoritesCountAttribute()
    {
        return $this->favorites->count();
    }

    public function isFavorited()
    {
        //        return $this->favorites()->where('user_id', auth()->id())->exists();
        return !! $this->favorites->where('user_id', auth()->id())->count();
    }

}