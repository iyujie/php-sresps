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
                    <h1>In-Demand Products  </h1>
                    
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
                        <th>Item Name</th>
                        <th>Quantity Sold</th>
                       
                    </tr>
                    <?php

                        require_once 'database.php';

                        $query= "SELECT ItemID, ItemName, SUM(Quantity) AS total FROM Sales GROUP BY ItemID ORDER BY total DESC LIMIT 5";
                        $result= mysqli_query($con, $query);
                        if ($result) {
                            while($row = mysqli_fetch_array($result)){   
                            echo "<tr>
                            <td>" . $row['ItemID'] . "</td>
                            <td>" . $row['ItemName'] . "</td>
                            <td>" . $row['total'] . "</td>
                            </tr>";  
                            }

                        }else
                        {
                            die('Invalid query: ' . mysqli_error());
                        }
                    ?>
                   
                </table>
                <div class="form-group">
                    <button type="submit" name="btn-save" class="btn btn-primary">Group by Week</button>
                    <button type="submit" name="btn-save" class="btn btn-primary">Group by Month</button>
                    <button type="submit" name="btn-save" class="btn btn-primary">Group by Year</button>
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