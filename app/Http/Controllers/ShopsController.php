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
        //if $type == prefered i'll show just liked and not showing the shops liked in the main page (all shops)
        $type = $request->shops;
        $prefered = ($type == 'prefered') ? true : false;

        $shops = Shop::getShops(auth()->id(), $prefered);

        return view ('shops.index', ['shops' => $shops, 'type' => $type]);
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

        $shop = Shop::where('id', $shopId);

        $liked = $request->liked;

        $now = time();

        
        $likedDislikedSohps = new likedDislikedSohps;

        $likedDislikedSohps::updateOrInsert(

            ['userId' => $userId, 'shopId' => $shopId],
            
            ['datetime' => $now, 'liked'=> $liked]
        );

        return likedDislikedSohps::all()->toArray();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
