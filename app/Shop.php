<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

use Jenssegers\Mongodb\Eloquent\Model; 

use App\likedDislikedSohps;

class Shop extends Model
{
    public $timestamps = false;

    public static function getShops($userId, $prefered = false ){

    	$shops = [];

    	$likedShops = likedDislikedSohps::where([

    				['userId', $userId], 

    				['liked', "1"]

    			])->pluck('shopId')->toArray();

    	if($prefered){

    		$shops = Shop::whereIn('_id', $likedShops)->get()->toArray();

    	}else{

    		$shops = Shop::whereNotIn('_id', $likedShops)->get()->toArray();

    	}

    	return $shops;
    }
}
