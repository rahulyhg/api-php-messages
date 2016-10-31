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