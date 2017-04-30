<!DOCTYPE html>
<html>
<head>
    <title>PHP-SRES</title>
    <meta name="viewport" content="width=device-width, intial-scale=1.0"/>
    <link href="https://bootswatch.com/simplex/bootstrap.min.css" rel="stylesheet"/>
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    
</head>
<body>
    <div class="container-fluid" style="width:15%; float:left; padding-top:15px; background-color:#f4f4f4;">
        <ul class="nav nav-pills nav-stacked">
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="index.php">Add Sales</a></li>
            <li><a href="addSales.php">Add/Delete Product</a></li>
            <li><a href="addSales.php">Add/Edit Stock</a></li>
            <li><a href="addSales.php">Sales Graph Visual</a></li>
            <li><a href="addSales.php">Add Sales</a></li>
            <li><a href="addSales.php">Add Sales</a></li>
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
    <div class="container-fluid" style="width:85%; float:right">
        <div class="row">
            <div class="col-xs-12">
                    <h1>People Health Pharmacy (PHP) Inc. Sales Module</h1>
                    
            </div>
        </div>
        
        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" id="search"  placeholder="Search item, customer, etc">
                </div>
                <table class="table table-stripped table-hover" id="table">
                    <tr>
                        <th>ID</th>
                        <th>Customer Name</th>
                        <th>Item Purchased</th>
                        <th>Country</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Date</th>
                       
                    </tr>
                    <!--tr data-ng-repeat="item in data | filter:search">
                        <td>{{item.id}}</td>
                        <td>{{item.name}}</td>
                        <td>{{item.item}}</td>
                        <td>{{item.country}}</td>
                        <td>{{item.quantity}}</td>
                        <td>{{item.price}}</td>
                        <td>{{item.date}}</td>
                        
                        <td style="border:none"> <button class="glyphicon glyphicon-edit" data-ng-click="editSales($index)"></button></td>
                        <td style="border:none"> <button class="glyphicon glyphicon-trash" data-ng-click="delSales($index)"></button></td>
                    </tr -->
                    <?php

                        $connect=mysql_connect('localhost', 'root', '');
                        

                        if(mysqli_connect_errno($connect))
                        {
                            echo 'Failed to connect';
                        }
                    
                        mysql_select_db('phpsres', $connect);

                        $query = "SELECT * FROM phpsres.Sales ORDER BY SalesID DESC"; 
                        $result = mysql_query($query);
                        if (!$result) { 
                            die('Invalid query: ' . mysql_error());
                        }else
                        {
                            while($row = mysql_fetch_array($result)){   
                                echo "<tr>
                                <td>" . $row['SalesID'] . "</td>
                                <td>" . $row['CustomerName'] . "</td>
                                <td>" . $row['ItemName'] . "</td>
                                <td>" . $row['Country'] . "</td>
                                <td>" . $row['Quantity'] . "</td>
                                <td>" . $row['Price'] . "</td>
                                <td>" . $row['SalesDate'] . "</td>";
                                echo "<td><a href=\"editSales.php?id=". $row['SalesID'] ."\" class='glyphicon glyphicon-pencil'></td>";
                                echo "<td><a href=\"deleteSales.php?id=". $row['SalesID'] ."\" class='glyphicon glyphicon-trash' onclick=\"return confirm('Are you sure to delete this?');\">";
                                echo "</tr>";  

                            }
                        }

                        

                        mysql_close(); 
                    
                    ?>
                   
                </table>
                <div class="form-group">
                    <a href="addSales.php" class="btn btn-primary">Add Sales</a>
                    <a href="exportData.php" class="btn btn-danger" style="display:inline; float:right;">Export into CSV file</a>
                </div>

            </div>
        </div>
    
    </div>
    
    
    
    <!--scripts-->
<script>

    var $rows = $('#table tr');
    $('#search').keyup(function() {

        var val = '^(?=.*\\b' + $.trim($(this).val()).split(/\s+/).join('\\b)(?=.*\\b') + ').*$',
            reg = RegExp(val, 'i'),
            text;

        $rows.show().filter(function() {
            text = $(this).text().replace(/\s+/g, ' ');
            return !reg.test(text);
        }).hide();
    });    

</script>    


    
    
</body>    
</html>