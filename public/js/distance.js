//script AngularJS Calculate Distance by Latitude, Longitude
//For the good working of this calculating the domaine must be https
var app = angular.module('prongbang', []);

app.service('Direction',function(){
  
    this.deg2rad = function(deg) { return (deg * Math.PI / 180.0); };
    this.rad2deg = function(rad) { return (rad * 180 / Math.PI); };
    

    this.distance = function(lat1, lon1, lat2, lon2, unit) {
        var theta = lon1 - lon2;
        var dist = Math.sin(this.deg2rad(lat1)) 
        * Math.sin(this.deg2rad(lat2)) 
        + Math.cos(this.deg2rad(lat1)) 
        * Math.cos(this.deg2rad(lat2)) 
        * Math.cos(this.deg2rad(theta));
        dist = Math.acos(dist);
        dist = this.rad2deg(dist);
        dist = dist * 60 * 1.1515;
        if (unit == "K") dist = dist * 1.609344;
        else if (unit == "N") dist = dist * 0.8684;
        return dist;
    };
});


app.controller('shopCtrl', function($scope,$http,$location,Direction){

  angular.element(document).ready(function(){

    $http.get('/nearby', {

                params: {

                  shops: $scope.typeShops,

                }

            })
              .then(function successCallback(response) {
                
                if (navigator.geolocation) {
        
                      navigator.geolocation.getCurrentPosition(function(position){

                      $scope.$apply(function(){
                        
                        var latlngA = {latitude:position.coords.latitude,longitude:position.coords.longitude};

                        var arrData = response.data.shops;
                        
                        angular.forEach(arrData, function(value, key){

                          var latlngB = {latitude:value.location.coordinates[1],longitude:value.location.coordinates[0]};
                          
                          $scope.calcdist(latlngA,latlngB);
                          
                          value.distance = $scope.dataset.distance;
                        
                        });

                        $scope.shops = arrData;

                      
                      });

                    });
                }else{

                  alert('Sorry, your connection it is not secure !')

                }

              });

  });

  $scope.calcdist = function(latlngA,latlngB){ 
        var lat1 = latlngA.latitude;
        var lng1 = latlngA.longitude;
        var lat2 = latlngB.latitude;
        var lng2 = latlngB.longitude;
        var dist = Direction.distance(lat1, lng1, lat2, lng2, "K");

        var from = lat1+","+lng1;
        var to = lat2+","+lng2;
        
        $scope.dataset = {
          from:from,
          to:to,
          distance:dist
        }; 
      }; 

})