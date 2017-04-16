<?php 
// Including database connections
require_once 'database_connections.php';
// Fetching the updated data & storin in new variables
$data = json_decode(file_get_contents("php://input")); 
// Escaping special characters from updated data
$ItemID = mysqli_real_escape_string($con, $data->ItemID);
$ItemID = mysqli_real_escape_string($con, $data->ItemName);
$ItemPrice = mysqli_real_escape_string($con, $data->ItemPrice);

// mysqli query to insert the updated data
$query = "UPDATE items SET ItemName='$ItemName',ItemPrice='$ItemPrice' WHERE ItemID=$ItemID";
mysqli_query($con, $query);
echo true;
?>