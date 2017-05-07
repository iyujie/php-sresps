


<!DOCTYPE html>
<html>
<head>
    <title>PHP-SRES</title>
    <meta name="viewport" content="width=device-width, intial-scale=1.0"/>
    <link href="https://bootswatch.com/simplex/bootstrap.min.css" rel="stylesheet"/>
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <script src="bootstrap-3.3.7-dist/js/jquery.min.js"></script>
    <script src="bootstrap-3.3.7-dist/js/bootstrap.js"></script>
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
                        
                        if(isset($_POST['btn-save']))
                        {


                            $start_date= $_POST['start_date'];
                            $end_date= $_POST['end_date'];
                            $query="select ItemID, ItemName, SUM(Quantity) AS total from Sales where SalesDate between '$start_date 00:00:00 and '$end_date 23:59:00' order by SalesDate desc limit 5";
                            $result = mysqli_query($con, $query);
                            if ($result) {
                                while($row = mysqli_fetch_array($result)){   
                                echo "<tr>
                                <td>" . $row['ItemID'] . "</td>
                                <td>" . $row['ItemName'] . "</td>
                                <td>" . $row['total'] . "</td>
                                </tr>"; 
                                }

                            }


                            echo "
                        <!DOCTYPE html>
                        <script>
                        function redir()
                        {
                        alert('Updated list.');
                        window.location.assign('predictSales.php');
                        }
                        </script>
                        <body onload='redir();'></body>";


                        }
                        else{

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
                        }
                    ?>
                   
                </table>
                <div class="form-group">
                <div class="btn-group" style="float:left">
                  <a href="#" class="btn btn-primary">Group Top Sales by</a>
                  <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Weekly</a></li>
                    <li><a href="#">Monthly</a></li>
                    <li><a href="#">Yearly</a></li>

                  </ul>
                </div>
                <form method="post">
                    <div class="form-group" style="width:30%; float:right;" >
                      <label class="control-label">Group Top Sales by Particular Date</label>
                      <div class="input-group">
                        <span class="input-group-addon">Start Date</span>
                        <input class="form-control" type="text" name="start_date" placeholder="yyyy/mm/dd">
                      </div>
                      <div class="input-group">
                        <span class="input-group-addon">End Date</span>
                        <input class="form-control" type="text" name="end_date" placeholder="yyyy/mm/dd">
                        <span class="input-group-btn">
                          <button type="submit" name="btn-save" class="btn btn-primary">Submit</button>
                        </span>
                      </div>
                    </div>
                </form>
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