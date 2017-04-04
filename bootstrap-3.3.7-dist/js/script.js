var app = angular.module("phpApp", ["ngRoute"]);
app.config(function ($routeProvider) {
    $routeProvider.when("/Items",{
        templateUrl:"view-list.html", controller: "listController"
    })
        .when("/Items/add", {
        templateUrl:"view-details.html", controller:"addController"
    })
    .when("/Items/:index",{
        templateUrl:"view-details.html", controller:"editController"
    })
    .otherwise({redirectTo:"/Items"})
})

app.factory("salesService", ["$rootScope", function($rootScope){
    var svc = {};
    
    var data = [
        {id:"001", item:"phyeeiana", name:"Sana Faiz", date:"4/4/2017", price:47.50},
        {id:"001", item:"phyeeiana", name:"Nurul", date:"4/4/2017", price:47.50},
        {id:"001", item:"phyeeiana", name:"leslie", date:"4/4/2017", price:47.50}
    ];
    
    svc.getSales = function()
    {
        return data;
    };
    
    svc.addSales = function(sales)
    {
        data.push(sales);
    };
    
    svc.editSales = function(index, sales)
    {
        data[index] = sales;
    };
    
    return svc;
}]);

app.controller("listController", ["$scope", "$location", "$routeParams", "salesService", function($scope, $location, $routeParams, salesService){
    $scope.data = salesService.getSales();
    
    $scope.addSales = function(){
      $location.path("/Items/add");  
    };
    
    $scope.editSales = function(x)
    {
        $location.path("/Items/" + x);
    };
    
    $scope.delSales = function(x)
    {
        //todo
    };
}]);



app.controller("addController", ["$scope", "$location", "$routeParams", "salesService", function($scope, $location, $routeParams, salesService){
    $scope.save = function()
    {
        salesService.addSales({name: $scope.Item.name, genre: $scope.Item.item});
        $location.path("/Items");
    };
    
    $scope.cancel = function()
    {
        $location.path("/Items")
    };
    
}]);

app.controller("editController", ["$scope", "$location", "$routeParams", "salesService", function($scope, $location, $routeParams, salesService){
    
    $scope.Item = salesService.getSales()[parseInt($routeParams.index)];
    
    $scope.save = function()
    {
        salesService.addSales(parseInt($routeParams.index), {name: $scope.Item.name, genre: $scope.Item.item});
        $location.path("/Items");
    };
    
    $scope.cancel = function()
    {
        $location.path("/Items")
    };
    
}]);