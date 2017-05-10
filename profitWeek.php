
<html ng-app="crudApp">
<head>
<title>Weekly Profit</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Include main CSS -->
<link href="https://bootswatch.com/simplex/bootstrap.min.css" rel="stylesheet"/>

<!-- Include jQuery library -->
<script src="bootstrap-3.3.7-dist/js/jQuery/jquery.min.js"></script>

<!-- Include AngularJS library -->
<script src="bootstrap-3.3.7-dist/lib/angular/angular.min.js"></script>

<!-- Include Bootstrap Javascript -->
<script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

</head>

<body >
	<div class="container-fluid" style="width:15%; float:left; padding-top:15px; background-color:#f4f4f4;">
			<ul class="nav nav-pills nav-stacked">
            <li class="active"><a href="index.php">Add Sales</a></li>
            <li><a href="listProduct.html">Add/Delete Product</a></li>
            <li><a href="listStock.html">Add/Edit Stock</a></li>
			<li><a href="Weekly.php">Weekly/Monthly Sales</a></li>
			<li><a href="profitDay.php">Daily/Weekly/Monthly Profit</a></li>
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
                    <h1>Weekly Profit</h1>   
            </div>
        </div>
		
		
		<div class="row">
            <div class="col-xs-12">
			
				<div class="form-group">
					<a href="profitDay.php" class="btn btn-primary">Daily Profit</a>
					<a href="profitWeek.php" class="btn btn-primary">Weekly Profit</a>
                    <a href="profitMonth.php" class="btn btn-primary">Monthly Profit</a>
                </div>
				
				<div class="clearfix"></div>
			
         
                <table id="myTable" class="table table-stripped table-hover" style="font-size:13px;">
                    <tr>
					<th>Week</th>
					<th>Profit Price</th>
					<th></th>
					<th></th>
					</tr>
					
					
                   <?php
						require_once "database.php";
						
						$query = "SELECT * FROM sales ORDER BY SalesDate ASC"; 
                        $result = mysqli_query($con, $query);
						$total = 0;
						
						if ($result) {
							
							$row = mysqli_fetch_array($result);
							$x = $row['SalesDate'];
							$time = strtotime($x);
							echo "<tr><td>";
							echo date('W', $time);
							echo date('S', $time);
							echo "  Week  of  ";
							echo date('Y', $time);
							echo "  in  ";
							echo date('F', $time);
							echo "</td>";
							do
                            {
								$x = $row['SalesDate'];
								
								$time1 = strtotime($x);
								if(date('m', $time) != date('m', $time1) || date('Y', $time) != date('Y', $time1) || date('W', $time) != date('W', $time1)){
									
									echo "
									<td>"  . number_format($total, 2) . "</td>";
									echo "</tr>"; 
									
									echo "<tr><td>";
									echo date('W', $time1);
									echo date('S', $time1);
									echo "  Week  of  ";
									echo date('Y', $time1);
									echo "  in  ";
									echo date('F', $time1);
									echo "</td>";
									
									$total = 0;
								}
								$x = $row['SalesDate'];
								$time = strtotime($x);
								
								$total = $total + $row['Price'];
                                
								
                            }while($row = mysqli_fetch_array($result));
							
							
							echo "
							<td>"  . number_format($total, 2). "</td>";
							echo "</tr>"; 
                        }
                
                    ?>
                    
                </table>
                

            </div>
        </div>
		
	</div>

<!-- Include controller -->

</body>
</html>