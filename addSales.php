<?php 

require_once 'database.php';


//if submit button is clicked submit
if(isset($_POST['btn-save']))
{
    
    //$data = json_decode(file_get_contents("php://input")); 
    
    //sotred variables from form
    $customer_name= $_POST['customer_name'];
    $item_id= $_POST['item_name'];
    //retrieve item name 
    $item_name_query = mysqli_query($con, "SELECT ItemName FROM Items WHERE ItemID ='$item_id'");
    $row = $item_name_query->fetch_assoc();
    $item_name = $row['ItemName'];
    
    
    $country= $_POST['country_name'];
    $quantity= $_POST['item_quantity'];
    $price= $_POST['item_price'];
    $sales_date= $_POST['sales_date'];
    
    //insert sales record
    
    //mysqli_query("INSERT INTO Sales (CustomerName, ItemID, ItemName, Country, Quantity, Price, SalesDate)  VALUES('Awful Days', 17, 'Xanax', 'Malaysia   ', 1, 48.3, 2012-01-02)");
    
    $query="INSERT INTO Sales (CustomerName, ItemID, ItemName, Country, Quantity, Price, SalesDate)  VALUES('$customer_name', '$item_id', '$item_name', '$country', '$quantity', '$price', '$sales_date')";
    mysqli_query($con, $query);
    
    
    //update stock count
    mysqli_query($con, "UPDATE Items SET StockLeft = StockLeft - '$quantity' WHERE ItemID = '$item_id'");


    //check stock after each record add
    $stock_checker_query=mysqli_query($con,"SELECT ItemName FROM Items WHERE StockLeft <= 5");
    $row2 = $stock_checker_query->fetch_assoc();
    $stock_left = $row2['ItemName'];
    if($stock_left != NULL)
    {
        $message = $stock_left + "is running out of stock!";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
            
            
          
    //return to index main page
    echo "
        <!DOCTYPE html>
        <script>
        function redir()
        {
        alert('Record successfully added.');
        window.location.assign('index.php');
        }
        </script>
        <body onload='redir();'></body>";

}

?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP-SRES</title>
    <meta name="viewport" content="width=device-width, intial-scale=1.0"/>
    <link href="https://bootswatch.com/simplex/bootstrap.min.css" rel="stylesheet"/>
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <script src="bootstrap-3.3.7-dist/js/jquery.min.js"></script>
    <script src="bootstrap-3.3.7-dist/js/bootstrap.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <h1>Add Sales</h1>
            
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <form method="post">
                

                <div class="form-group">
                    <label for="custName">Customer Name:</label>
                    <input type="text" name="customer_name" class="form-control" required/>
                </div>    

                <div class="form-group">
                    <label for="itemName">Item Purchased:</label>
                    <?php include "database.php";
                        $result = mysqli_query($con, "SELECT ItemID, ItemName FROM Items");

                        echo "<select name='item_name' class='form-control'>";
                        while ($row = mysqli_fetch_array($result)) 
                        {
                            echo "<option value='" . $row['ItemID'] . "'>". $row['ItemID'] . " - " . $row['ItemName'] ."</option>";
                        }
                        echo "</select>";
                    ?>

                </div>

                <div class="form-group">
                    <label for="Country">Country:</label>
                    <select name="country_name" class="form-control">
                        <option value='Malaysia'>Malaysia</option>
                        <option value='Thailand'>Thailand</option>
                        <option value='Singaore'>Singapore</option>
                        <option value='Phillipines'>Phillipines</option>
                        <option value='Vietnam'>Vietnam</option>
                        <option value='Other'>Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="Quantity">Quantity:</label>
                    <input type="text" name="item_quantity" class="form-control" required/>
                </div>   

                <div class="form-group">
                    <label for="itemPrice">Total Price (MYR):</label>
                    <input type="text" name="item_price" class="form-control" required/>
                </div>


                <div class="form-group">
                    <label for="dateSold">Date:</label>         
                    <input type='text' name="sales_date" id="date_picker1" size=9 class="form-control" />

                </div>


                <div class="form-group">
                    <button type="submit" name="btn-save" class="btn btn-primary">Save</button>
                    <a href="index.php" class="btn btn-primary">Cancel</a>
                </div>


                </form>
            </div>
            
        </div>
    </div>
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
       
