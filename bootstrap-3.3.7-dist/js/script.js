var app = angular.module("phpApp", ["ngRoute"]);
app.config(['$routeProvider', '$locationProvider', function($routeProvider, $locationProvider) {
  $routeProvider.when("/Items", {
      templateUrl: "view-list.php",
      controller: "listController"
    })
    .when("/Items/add", {
      templateUrl: "add.php",
      controller: "addController"
    })
    .otherwise({
      redirectTo: "/Items"
    });

}]);

app.factory("salesService", ["$rootScope", function($rootScope) {
  var svc = {};

  var data = [{
    id: "1",
    item: "Xanax",
    name: "Steins",
    date: "04/06/2017",
    price: 247.50
  }, {
    id: "2",
    item: "Viagra",
    name: "Esse",
    date: "05/03/2017",
    price: 198.50
  }];

  svc.getSales = function() {
    return data;
  };

  svc.addSales = function(sales) {
    data.push(sales);
  };

  svc.editSales = function(index, sales) {
    data[index] = sales;
  };

  svc.delSales = function(index, sales) {
    data[index] = sales;
  };


  return svc;
}]);

app.controller('listController', ['$scope', '$location', '$routeParams', 'salesService',
  function($scope, $location, $routeParams, salesService) {
    $scope.data = salesService.getSales();

    $scope.addSales = function() {
      $location.path('/Items/add');
    };

    $scope.editSales = function(x) {
      $location.path("/Items/" + x);
    };

    $scope.delSales = function(x) {
      if (confirm('Are you sure to delete?')) {
        alert("deleted item asdasd");
        //var index = $scope.bdays.indexOf(item);
        //$scope.bdays.splice(index, 1);
      }
      $location.path("/Items");
    };


  }
]);



app.controller('addController', ['$scope', '$location', '$routeParams', 'salesService',
  function($scope, $location, $routeParams, salesService) {
    

    $scope.cancel = function() {
      $location.path('/Items');
    };
  }
]);

app.controller('editController', ['$scope', '$location', '$routeParams', 'salesService',
  function($scope, $location, $routeParams, salesService) {
    

    $scope.cancel = function() {
      $location.path('/');
    };


  }
]);