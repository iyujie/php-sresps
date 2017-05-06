// Application module
var crudApp = angular.module('crudApp',[]);
crudApp.controller("DbController",['$scope','$http', function($scope,$http){

// Function to get product details from the database
getInfo();
function getInfo(){
// Sending request to EmpDetails.php files 
$http.post('databaseFiles/empStock.php').success(function(data){
// Stored the returned data into scope 
$scope.details = data;
});
}

// Enabling show_form variable to enable Add product button
$scope.show_form = true;
// Function to add toggle behaviour to form
$scope.formToggle =function(){
$('#ProductForm').slideToggle();
$('#editProductForm').css('display', 'none');
}
$scope.insertProduct = function(info){
$http.post('databaseFiles/insertDetails.php',{"ItemName":info.ItemName,"ItemPrice":info.ItemPrice}).success(function(data){
if (data == true) {
getInfo();
$('#ProductForm').css('display', 'none');
}
});
}
$scope.deleteProductInfo = function(info){
$http.post('databaseFiles/deleteDetails.php',{"del_id":info.ItemID}).success(function(data){
if (data == true) {
getInfo();
}
});
}
$scope.currentProduct = {};
$scope.editProductInfo = function(info){
$scope.currentProduct = info;
$('#ProductForm').slideUp();
$('#editProductForm').slideToggle();
}
$scope.UpdateProductInfo = function(info){
$http.post('databaseFiles/updateStock.php',{"ItemID":info.ItemID,"Amount":info.StockLeft}).success(function(data){
$scope.show_form = true;
if (data == true) {
getInfo();
}
});
}
$scope.updateMsg = function(ItemID){
$('#editProductForm').css('display', 'none');
}
}]);