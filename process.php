<?php include 'database.php'; ?>

<?php


$customer_name=$_POST['CustomerName'];
$item_id=$_POST['ItemName'];
$country=$_POST['Country'];
$quantity=$_POST['Quantity'];
$price=$_POST['Price'];
$sales_date=$_POST['SalesDate'];

//Execute the query


mysqli_query($connect,"INSERT INTO Sales(SalesID,CustomerName,ItemID,Country,Quantity,Price,SalesDate)
		        VALUES (NULL, '$customer_name','$item_id','$country','$quantity', '$price', '$sales_date')");
				
if(mysqli_affected_rows($connect) > 0){
	echo "<p>Sales Added</p>";
	echo "<a href="index.html">Go Back</a>";
} else {
	echo "Sales NOT Added<br />";
	echo mysqli_error ($connect);
}