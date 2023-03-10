<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'area_id','genre_id','summary','picture_name'];
    public function area()
    {
        return $this->belongsTo('App\Models\Area');
    }
    public function genre()
    {
        return $this->belongsTo('App\Models\Genre');
    }
    public function reservations()
    {
        return $this->hasMany('App\Models\Reservation');
    }
    public function favorites()
    {
        return $this->hasMany('App\Models\Favorite');
    }
}
