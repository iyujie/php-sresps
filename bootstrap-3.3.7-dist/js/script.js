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

app.controller('listController', ['$scope', '$location', '$routeParams',
  function($scope, $location, $routeParams) {
    

    $scope.addSales = function() {
      $location.path('/Items/add');
    };

    $scope.editSales = function(x) {
      $location.path("/Items/" + x);
    };

  }
]);



app.controller('addController', ['$scope', '$location', '$routeParams',
  function($scope, $location, $routeParams) {
    $scope.save = function() {
      $location.path('/');
    }

    $scope.cancel = function() {
      $location.path('/');
    };
  }
]);

app.controller('editController', ['$scope', '$location', '$routeParams',
  function($scope, $location, $routeParams) {
    

    $scope.cancel = function() {
      $location.path('/');
    };


  }
]);