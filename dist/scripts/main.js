var aplicacion = angular.module('myApp', ['ngRoute']);


aplicacion.config(['$httpProvider', function ($httpProvider) {
    // Reset headers to avoid OPTIONS request:
    $httpProvider.defaults.headers.common  = {};
    $httpProvider.defaults.headers.post    = {};
    $httpProvider.defaults.headers.put     = {};
    $httpProvider.defaults.headers.patch   = {};
    $httpProvider.defaults.withCredentials = true;
}]);

aplicacion.config(function($routeProvider) {
    $routeProvider
    .when('/',{
       templateUrl: 'pages/home.html',
       controller:'homeController'
    })
    .when('/about',{
       templateUrl: 'pages/about.html',
       controller:'aboutController'
    })
    .when('/services',{
       templateUrl: 'pages/services.html',
       controller:'servicesController'
    })
    .when('/contact',{
       templateUrl: 'pages/contact.html',
       controller:'contactController'
    })
    .otherwise({
            redirectTo: '/'
    });
});

aplicacion.controller('homeController',function($scope){
    
});

aplicacion.controller('servicesController',function($scope){
    
});
aplicacion.controller('aboutController',function($scope){
    
});
aplicacion.controller('contactController',function($scope, $http){
    var apiURL="/api/messages";
    $scope.load  = function(){
        $http({
            method : "GET",
            url : apiURL
        }).then(function succes(response) {
            $scope.messages = response.data;
        }, function error(response) {
            alert(response.statusText);
        });
    }; 
    $scope.send  = function(){
        $http({
            method: "POST",
            url : apiURL,
            data: $scope.objMessage
        }).then(function success(response) {
            $scope.load();
            $scope.objMessage.name="";$scope.objMessage.email="";$scope.objMessage.message="";
        }, function error(response) {
            alert(response.statusText);
        });
    }; 
    
    $scope.delete  = function(id){
        $http({
            method: "DELETE",
            url : apiURL+"/"+id
        }).then(function success(response) {
            $scope.load();
        }, function error(response) {
            alert(response.statusText);
        });
    };
    
    
    
});