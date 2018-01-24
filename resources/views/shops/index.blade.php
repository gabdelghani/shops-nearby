@extends('layouts.app')

@section ('pageName')
    | Nearby
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading text-right">

                    <a class="btn btn-link {{$type == 'nearby' ? 'active' : ''}}" href="{{route('listingShops', ['shops' => 'nearby' ])}}">Nearby Shops</a> 
                    <a class="btn btn-link {{$type == 'prefered' ? 'active' : ''}}" href="{{route('listingShops', ['shops' => 'prefered' ])}}">My prefered Shops</a>

                </div>

                <div id="shop" class="panel-body">

                    @foreach($shops as $shop)

                        <div class="col-sm-3 text-center">
                            <div class="oneshop">
                                <h4>{{$shop['name']}}</h4>
                                <img src="{{$shop['picture']}}" alt="{{$shop['name']}}">
                                <div class="btn-panel">
                                    @if($type == 'prefered')
                                    <a class="btn btn-danger" href="{{route('like', ['shopId' => $shop['_id'], 'liked' => 0])}}">Remove</a>
                                    @else
                                    <a class="btn btn-danger" href="{{route('like', ['shopId' => $shop['_id'], 'liked' => 0])}}">Dislike</a>

                                    <a class="btn btn-success" href="{{route('like', ['shopId' => $shop['_id'], 'liked' => 1])}}">Like</a>
                                    @endif
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
