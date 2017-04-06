var app = angular.module("phpApp", ["ngRoute"]);
app.config(function ($routeProvider, $locationProvider) {
    $routeProvider.when("/Items",{
        templateUrl:"view-list.html", controller: "listController"
    })
        .when("/Items/add", {
        templateUrl:"view-details.html", controller:"addController"
    })
    .when("/Items/:index",{
        templateUrl:"view-details.html", controller:"editController"
    })
    .otherwise({
    redirectTo:"/Items"
    })
});

app.factory("salesService", ["$rootScope", function($rootScope){
    var svc = {};
    
    var data = [
        {id:"1", item:"Xanax", name:"Sana Faiz", date:"04/06/2017", price:247.50},
        {id:"2", item:"Viagra", name:"Nurul", date:"05/03/2017", price:198.50}
    ];
    
    svc.getSales = function()
    {
        return data;
    };
    
    svc.addSales = function(sales) {
        data.push(sales);
    };
    
    svc.editSales = function(index, sales)
    {
        data[index] = sales;
    };
    
    svc.delSales = function(index, sales)
    {
        data[index] = sales;
    };
    
    
    return svc;
}]);

app.controller("listController", ["$scope", "$location", "$routeParams", "salesService", 
                                  function($scope, $location, $routeParams, salesService){
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
        if (confirm('Are you sure to delete?'))
        {
             alert("deleted item asdasd");
            //var index = $scope.bdays.indexOf(item);
            //$scope.bdays.splice(index, 1);
        }
        $location.path("/Items");
    };
                                      
    
}]);



app.controller("addController", ["$scope", "$location", "$routeParams", "salesService", 
                                  function($scope, $location, $routeParams, salesService){
    $scope.saveStuff = function()
    {
        salesService.addSales({id: $scope.Item.id, item: $scope.Item.item, name: $scope.Item.name, date: $scope.Item.date, price: $scope.Item.price});
        $location.path("/Items");
    };
    
    $scope.cancelStuff = function()
    {
        $location.path("/Items")
    };
}]);

app.controller("editController", ["$scope", "$location", "$routeParams", "salesService", 
                                  function($scope, $location, $routeParams, salesService){  
    $scope.Item = salesService.getSales()[parseInt($routeParams.index)];
    
    $scope.saveStuff = function(){salesService.addSales(parseInt($routeParams.index), {id: $scope.Item.id, item: $scope.Item.item, name: $scope.Item.name, date: $scope.Item.date, price: $scope.Item.price});
                             $location.path("/Items");};
    
    $scope.cancelStuff = function(){
        $location.path("/Items")
    };
                                      
    
}]);




