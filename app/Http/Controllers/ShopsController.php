<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Shop;

use App\likedDislikedSohps;

class ShopsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $type = $request->shops;

        if(is_null($request->shops)) 
            return redirect('/?shops=nearby');

        return view ('shops.nearby', ['type' => $type]);
    }

    /**
     * nearby methode will be called by the $http.get methode in distance.js file.
     *
     * @return \Illuminate\Http\Response
     */
    public function nearby(Request $request)
    {
        //if $type == prefered i'll show just liked and not showing the shops liked in the main page (nearby shops)
        $type = $request->shops;

        $prefered = ($type == 'prefered') ? true : false;
        
        $shops = Shop::getShops(auth()->id(), $prefered);

        return response()->json(['shops' => $shops]);

    }

     /**
     * update shops liked / disliked [1 == liked, 0 == disliked].
     *
     * @return \Illuminate\Http\Response
     */
    public function like(Request $request)
    {

        $userId = auth()->id();

        $shopId = $request->shopId;

        $liked = $request->liked;

        $now = time();
        
        $likedDislikedSohps = new likedDislikedSohps;

        $shop = Shop::find($shopId);

        //likde == 3 ==> remove from likdedisliked shops collection
        if($liked == "3"){

            $likedDislikedSohps->where(['userId' => $userId, 'shopId' => $shopId])->delete();

            $message = 'The shop: <u>'. $shop->name .'</u> has been REMOVED from yout prefered shops !';
        
        }else{

            $likedDislikedSohps::updateOrInsert(

                ['userId' => $userId, 'shopId' => $shopId],
                
                ['datetime' => $now, 'liked'=> $liked]
            );

            $likedStatus = ($liked) ? 'prefered shops' : 'disliked shops, it will not be in the nearby shops for 2 hours';

            $message = 'The shop: <u>'. $shop->name .'</u> has been added to your '.$likedStatus.'  !';
        }

        return redirect()->back()->with('message', $message);

    }

}
