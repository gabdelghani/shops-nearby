<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

use Jenssegers\Mongodb\Eloquent\Model; 

class Shop extends Model
{
    public $timestamps = false;

    public static function getShops($prefered = false ){

    	return Shop::all()->toArray();

    }
}
