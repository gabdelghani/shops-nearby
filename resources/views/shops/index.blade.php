@extends('layouts.app')

@section ('pageName')
    | Nearby
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading text-right"><a class="btn" href="{{route('listingShops', ['shops' => 'nearby' ])}}">Nearby Shops</a> <a class="btn" href="{{route('listingShops', ['shops' => 'prefered' ])}}">My prefered Shops</a></div>

                <div id="shop" class="panel-body">

                    @foreach($shops as $shop)

                        <div class="col-sm-3 text-center">
                            <div class="border border-primary">
                                <h4>{{$shop['name']}}<h4>
                                <img src="{{$shop['picture']}}" alt="{{$shop['name']}}">
                                <div>
                                    <a href="{{route('like', ['shopId' => $shop['_id'], 'liked' => 0])}}">Dislike</a><a href="{{route('like', ['shopId' => $shop['_id'], 'liked' => 1])}}">Like</a>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
