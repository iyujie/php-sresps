<html ng-app="crudApp">
<head>
<title>Weekly Sales</title>
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
			
			<!--div class="list-group">
				  <a href="index.php" class="list-group-item">Home</a>
				  <a href="addSales.php" class="list-group-item">Add Sales</a>
				  <a href="index.php" class="list-group-item">Add/Delete Product</a>
				<a href="#" class="list-group-item">Edit Stock</a>
			</div-->
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
				
				<div class="clearfix"></div>
				
         
                <table class="table table-stripped table-hover" style="font-size:13px;">
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
					
					<!--<tr ng-repeat="detail in details| filter:search_query">
						<td>
							<span>{{detail.SalesID}}</span>
						</td>
						<td>{{detail.CustomerName}}</td>
						<td>{{detail.ItemName}}</td>
						<td>{{detail.Country}}</td>
						<td>{{detail.Quantity}}</td>
						<td>{{detail.Price}}</td>
						<td>{{detail.SalesDate}}</td>
						<td>
							<a class="glyphicon glyphicon-pencil" ng-click="editProductInfo(detail)" title="Edit"/>
						</td>
						<td>
							<a class="glyphicon glyphicon-trash" ng-click="deleteProductInfo(detail)" title="Delete"/>
						</td>
					</tr-->
                   <?php

                        $connect=mysql_connect('localhost', 'root', '');
                        

                        if(mysqli_connect_errno($connect))
                        {
                            echo 'Failed to connect';
                        }
                    
                        mysql_select_db('phpsres', $connect);

                        $query = "SELECT * FROM sales ORDER BY SalesDate ASC"; 
                        $result = mysql_query($query);
                        if (!$result) { 
                            die('Invalid query: ' . mysql_error());
                        }else
                        {
							$row = mysql_fetch_array($result);
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
								
								
                            }while($row = mysql_fetch_array($result));
							
                        }

                        

                        mysql_close(); 
                    
                    ?>
                    
                </table>
                

            </div>
        </div>
		
		
		
		
		
		
		
		
		
		
			
			
			
			
		

		
	</div>

<!-- Include controller -->


</body>
</html>