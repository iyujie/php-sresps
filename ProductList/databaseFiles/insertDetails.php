<?php 
// Including database connections
require_once 'database_connections.php';
// Fetching and decoding the inserted data
$data = json_decode(file_get_contents("php://input")); 
// Escaping special characters from submitting data & storing in new variables.
$ItemName = mysqli_real_escape_string($con, $data->ItemName);
$ItemPrice = mysqli_real_escape_string($con, $data->ItemPrice);

// mysqli insert query
$query = "INSERT into items (ItemName,ItemPrice) VALUES ('$ItemName','$ItemPrice')";
// Inserting data into database
mysqli_query($con, $query);
echo true;
?>