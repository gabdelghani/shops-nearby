@extends('layouts.app')

@section ('pageName')
    | Nearby
@endsection

@section('content')

<div class="container" ng-app="prongbang" ng-controller="shopCtrl">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading text-right">

                    <a class="btn btn-link {{$type == 'nearby' ? 'active' : ''}}" href="{{route('listingShops', ['shops' => 'nearby' ])}}">Nearby Shops</a> 
                    <a class="btn btn-link {{$type == 'prefered' ? 'active' : ''}}" href="{{route('listingShops', ['shops' => 'prefered' ])}}">My prefered Shops</a>

                </div>
                    
                @if( session('message') )
                    
                <div class="alert alert-success text text-center">{!! session('message') !!}</div>
                    
                @endif

                <div id="shop" class="panel-body">
                        <input type="hidden" ng-model="typeShops" ng-init='typeShops="{{$type}}"'>
                        <div ng-repeat="shop in shops | orderBy:'distance'" class="col-sm-3 text-center shop">

                            <div class="oneshop">
                                <h4 ng-bind="shop.name"></h4>
                                <img ng-src="@{{shop.picture}}" alt="">
                                <div class="btn-panel">

                                    @if($type == 'prefered')
                                    <a class="btn btn-danger" ng-href="{{route('like', ['liked' => 3])}}&shopId=@{{shop._id}}">Remove</a>
                                    @else
                                    <a class="btn btn-danger" ng-href="{{route('like', ['liked' => 0])}}&shopId=@{{shop._id}}">Dislike</a>

                                    <a class="btn btn-success" ng-href="{{route('like', ['liked' => 1])}}&shopId=@{{shop._id}}">Like</a>
                                    @endif
                                    
                                    <input type="hidden" class="distance" value="@{{shop.distance}}">
                                    <input type="hidden" class="latitude" value="@{{shop.location.coordinates[1]}}">
                                    <input type="hidden" class="longitude" value="@{{shop.location.coordinates[0]}}">
                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
