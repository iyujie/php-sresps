<?php
require_once"database.php";
if(isset($_POST['btn-generate']))
{
$date1= $_POST["date1"];
$date2= $_POST["date2"];
}

?>


<html ng-app="crudApp">
<head>
<title>Weekly Sales</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Include main CSS -->
<link href="https://bootswatch.com/simplex/bootstrap.min.css" rel="stylesheet"/>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

<!-- Include jQuery library -->
<script src="bootstrap-3.3.7-dist/js/jQuery/jquery.min.js"></script>

<!-- Include AngularJS library -->
<script src="bootstrap-3.3.7-dist/lib/angular/angular.min.js"></script>

<!-- Include Bootstrap Javascript -->
<script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
</head>

<body >
	<div class="container-fluid" style="width:15%; float:left; padding-top:15px; background-color:#f4f4f4;">
			<ul class="nav nav-pills nav-stacked">
            <li class="active"><a href="index.php">Add Sales</a></li>
            <li><a href="listProduct.html">Add/Delete Product</a></li>
            <li><a href="listStock.html">Add/Edit Stock</a></li>
			<li><a href="Weekly.php">Weekly/Monthly Sales</a></li>
            <li><a href="#">Sales Graph Visual</a></li>
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
                    <h1>Weekly Sales</h1>   
            </div>
        </div>
		
		
		<div class="row">
            <div class="col-xs-12">
			
				<div class="form-group">
					<a href="Weekly.php" class="btn btn-primary">Weekly</a>
                    <a href="Monthly.php" class="btn btn-primary">Monthly</a>
                </div>
				
			<form name="form1" method="post" >	
				 <div class="col-md-2">Start Date: <input type="text" id="date_picker1" name="date1" size=9 value="<?php if (isset($_POST['date1'])) echo $_POST['date1']; ?>"/></div>
				<div class="col-md-2">End Date: <input type="text" id="date_picker2" name="date2" size=9 value="<?php if (isset($_POST['date2'])) echo $_POST['date2']; ?>"/></div>
				<div class="form-group">
                    <button type="submit" name="btn-generate" class="btn btn-primary">Generate</button>
					<a href="Weekly.php"><input type=button class="btn btn-primary" value="Refresh"></a>
                </div>
			</form>
				<div class="clearfix"></div>
			
         
                <table id="myTable" class="table table-stripped table-hover" style="font-size:13px;">
                    <tr>
					<th>Sales ID</th>
					<th>Customer Name</th>
					<th>Product Name</th>
					<th>Country</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Sales Date</th>
					<th>Day</th>
					<th></th>
					<th></th>
					</tr>
					
					
                   <?php
						require_once "database.php";
						
						$query = "SELECT * FROM sales ORDER BY SalesDate ASC"; 
                        $result = mysqli_query($con, $query);
						
						if (!empty($date1) && !empty($date2) && isset($_POST['btn-generate'])){
						$query1 = "SELECT * FROM sales WHERE SalesDate between '$date1' and '$date2' ORDER BY SalesDate ASC"; 
						$result1 = mysqli_query($con, $query1);
						
						$row = mysqli_fetch_array($result1);
							$x = $row['SalesDate'];
							$time = strtotime($x);
							echo "<tr><th colspan='8'>";
							echo date('W', $time);
							echo date('S', $time);
							echo "  Week  of  ";
							echo date('Y', $time);
							echo "  in  ";
							echo date('F', $time);
							echo "</th></tr>";
							do
                            {
								$x = $row['SalesDate'];
								
								$time1 = strtotime($x);
								if(date('m', $time) != date('m', $time1) || date('Y', $time) != date('Y', $time1) || date('W', $time) != date('W', $time1)){
									echo "<tr><td colspan='8'></td></tr>";
									echo "<tr border='0'><td colspan='8'></td></tr>";
									echo "<tr border='0'><td colspan='8'></td></tr>";
									echo "<tr><th colspan='8'>";
									echo date('W', $time1);
									echo date('S', $time1);
									echo "  Week  of  ";
									echo date('Y', $time1);
									echo "  in  ";
									echo date('F', $time1);
									echo "</th></tr>";
								}
								$x = $row['SalesDate'];
								$time = strtotime($x);
								
                                echo "<tr>
                                <td>" . $row['SalesID'] . "</td>
                                <td>" . $row['CustomerName'] . "</td>
                                <td>" . $row['ItemName'] . "</td>
                                <td>" . $row['Country'] . "</td>
                                <td>" . $row['Quantity'] . "</td>
                                <td>" . $row['Price'] . "</td>
                                <td>" . $row['SalesDate'] . "</td>";
								echo "<td>";
								echo date('l', $time);
								echo "</td>";
                                echo "</tr>"; 
								
                            }while($row = mysqli_fetch_array($result1));
							
						}else if ($result) { 
							$row = mysqli_fetch_array($result);
							$x = $row['SalesDate'];
							$time = strtotime($x);
							echo "<tr><th colspan='8'>";
							echo date('W', $time);
							echo date('S', $time);
							echo "  Week  of  ";
							echo date('Y', $time);
							echo "  in  ";
							echo date('F', $time);
							echo "</th></tr>";
							do
                            {
								$x = $row['SalesDate'];
								
								$time1 = strtotime($x);
								if(date('m', $time) != date('m', $time1) || date('Y', $time) != date('Y', $time1) || date('W', $time) != date('W', $time1)){
									echo "<tr><td colspan='8'></td></tr>";
									echo "<tr border='0'><td colspan='8'></td></tr>";
									echo "<tr border='0'><td colspan='8'></td></tr>";
									echo "<tr><th colspan='8'>";
									echo date('W', $time1);
									echo date('S', $time1);
									echo "  Week  of  ";
									echo date('Y', $time1);
									echo "  in  ";
									echo date('F', $time1);
									echo "</th></tr>";
								}
								$x = $row['SalesDate'];
								$time = strtotime($x);
								
                                echo "<tr>
                                <td>" . $row['SalesID'] . "</td>
                                <td>" . $row['CustomerName'] . "</td>
                                <td>" . $row['ItemName'] . "</td>
                                <td>" . $row['Country'] . "</td>
                                <td>" . $row['Quantity'] . "</td>
                                <td>" . $row['Price'] . "</td>
                                <td>" . $row['SalesDate'] . "</td>";
								echo "<td>";
								echo date('l', $time);
								echo "</td>";
                                echo "</tr>"; 
								
                            }while($row = mysqli_fetch_array($result));
							
                        }

                        

                    
                    ?>
                    
                </table>
                

            </div>
        </div>
		
	</div>

<!-- Include controller -->
<script>
$(document).ready(function() {

	var startDate;
	var endDate;
	$( "#date_picker1" ).datepicker({
		dateFormat: 'yy-mm-dd'
	})

	
	$( "#date_picker2" ).datepicker({
		dateFormat: 'yy-mm-dd'
	});

	$('#date_picker1').change(function() {
		startDate = $(this).datepicker('getDate');
		$("#date_picker2").datepicker("option", "minDate", startDate );
	})


	$('#date_picker2').change(function() {
		endDate = $(this).datepicker('getDate');
		$("#date_picker1").datepicker("option", "maxDate", endDate );
	})

})

</script>

</body>
</html>