var app = angular.module("phpApp", ["ngRoute"]);
app.config(function($routeProvider){
    $routeProvider.when("/Items",{templateUrl:"view-list.html", controller: "listController"})
    .when("/Items/add",{templateUrl:"view-detail.html", controller: "addController"})
    .when("/Items/:index",{templateUrl:"view-detail.html", controller: "editController"})
    .otherwise({redirectTo: "/Items"})
})


app.controller("listController", ["$scope", "$location", "$routeParams", function($scope, $location, $routeParams){
    $scope.data = [
      {id:"001", item:"phyeeiana", name:"Sana Faiz", date:"4/4/2017", price:47.50},
        {id:"001", item:"phyeeiana", name:"Nurul", date:"4/4/2017", price:47.50},
        {id:"001", item:"phyeeiana", name:"leslie", date:"4/4/2017", price:47.50}
    ];
    
    $scope.addSales = function(){
      $location.path("Items/add");  
        
    };
}]);

app.controller("addController", ["$scope", "$location", "$routeParams", function($scope, $location, $routeParams){
}]);

app.controller("editController", ["$scope", "$location", "$routeParams", function($scope, $location, $routeParams){
}]);