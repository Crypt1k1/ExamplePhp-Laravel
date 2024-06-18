<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    public function review()
    {
 return $this->hasMany(Review::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_cars', 'car_id', 'user_id');
    }
    public function favoritedBy()
    {
        return $this->hasMany(User::class, 'favorite_car_id');
    }
}
