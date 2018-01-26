<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

use Jenssegers\Mongodb\Eloquent\Model; 

use App\likedDislikedSohps;

class Shop extends Model
{
    public $timestamps = false;

    //Listing of shops by the userId and the type of shops (prefered == true) ==> prefered shops else nearby shops
    public static function getShops($userId, $prefered = false ){

    	$shops = [];

    	$now = time();

    	$likedShops = likedDislikedSohps::where([

    				['userId', $userId], 

    				['liked', "1"]

    			])->pluck('shopId')->toArray();

    	$dislikedShops = likedDislikedSohps::where([

    				['userId', $userId], 

    				['liked', "0"]

    			])
    			
    			->whereBetween('datetime', [$now - 7200, $now])

    	        ->pluck('shopId')->toArray();

    	if($prefered){

    		$shops = Shop::whereIn('_id', $likedShops)->get()->toArray();

    	}else{

    		$shops = Shop::whereNotIn('_id', $likedShops)

	    			->whereNotIn('_id', $dislikedShops)

	    			->get()->toArray();

    	}

    	return $shops;
    }
}
