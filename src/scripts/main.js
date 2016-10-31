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