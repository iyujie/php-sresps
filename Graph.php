

<?php
//database
require_once 'database.php'; 

//query to get data from the table
$query = "SELECT SalesDate, ItemName, Price FROM sales ORDER BY SalesDate ASC";

//execute query
$result2 = mysqli_query($con, $query);

//loop through the returned data
//$data = array();
//foreach ($result2 as $row) {
	//$data[] = array($row['SalesDate'], $row['ItemName'], $row['Price']);
//}

//now print the data

?>

<html ng-app="crudApp">
<head>
<title>Sales Graph Visual</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Include main CSS -->
<link href="https://bootswatch.com/simplex/bootstrap.min.css" rel="stylesheet"/>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link rel="stylesheet" src="//cdnjs.cloudflare.com/ajax/libs/dygraph/2.0.0/dygraph.min.css" />

<!-- Include jQuery library -->
<script src="bootstrap-3.3.7-dist/js/jQuery/jquery.min.js"></script>

<!-- Include AngularJS library -->
<script src="bootstrap-3.3.7-dist/lib/angular/angular.min.js"></script> 

<!-- Include Bootstrap Javascript -->
<script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
	
	
<!-- Include Dygraph.js -->
<script src="//cdnjs.cloudflare.com/ajax/libs/dygraph/2.0.0/dygraph.min.js"></script>

</head>

<body >		
	<div class="container-fluid" style="width:15%; float:left; padding-top:15px; background-color:#f4f4f4;">
			<ul class="nav nav-pills nav-stacked">
            <li class="active"><a href="index.php">Add Sales</a></li>
            <li><a href="listProduct.html">Add/Delete Product</a></li>
            <li><a href="listStock.html">Add/Edit Stock</a></li>
			<li><a href="Weekly.php">Weekly/Monthly Sales</a></li>
			<li><a href="profitDay.php">Daily/Weekly/Monthly Profit</a></li>
            <li><a href="Graph.php">Sales Graph Visual</a></li>
            <li><a href="predictSales.php">Check In-Demand Products</a></li>
          <li class="disabled"><a href="#">Disabled</a></li>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
              Dropdown <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li class="divider"></li>
              <li><a href="#">Separated link</a></li>
            </ul>
          </li>
        </ul>	
	</div>
	
	<div class="container-fluid" style="width:85%; float:right" ng-controller="DbController">

		<div class="row">
            <div class="col-xs-12">
                    <h1>Sales Graph Visual</h1>   
            </div>
        </div>
		
		
		<div class="row">
            <div class="col-xs-12">
			
				<div class="clearfix"></div>
		
            </div>
        </div>
		
		
		<div id="graphdiv2" style="width:800px; height:500px;"></div> 
		
<script type="text/javascript">
  g2 = new Dygraph(
    document.getElementById("graphdiv2"),
    [
	<?php
	if($result2){
$row = mysqli_fetch_array($result2);
	$x = $row['SalesDate'];
	$time = strtotime($x);
	$total=0;
	echo "[ new Date(\"" . $row['SalesDate'] . "\"),";
	do{
								$x = $row['SalesDate'];
								
								$time1 = strtotime($x);
								
					if(date('m', $time) != date('m', $time1) || date('Y', $time) != date('Y', $time1) || date('d', $time) != date('d', $time1)){
									
									echo  number_format($total, 2) . "]";
									
									echo ", [ new Date(\"" . $row['SalesDate'] . "\"),";
									$total = 0;
					}							
					$x = $row['SalesDate'];
					$time = strtotime($x);		
					$total = $total + $row['Price'];
					
				   
	}while($row = mysqli_fetch_array($result2));
	echo  number_format($total, 2) . "]";
}
	?>
	],
	{
				
                labels: [ "Date", "Profit Price"],
				
        
				showRangeSelector: true
              });
</script>
		
	</div>

<!-- Include controller -->





</body>
</html>