<?php 

require_once 'database.php';

$id = $_GET['id'];
$query = "SELECT * FROM Sales WHERE SalesID='$id'"; 
$result = mysqli_query($con, $query);


    $fetched=$result->fetch_assoc();
    $prequantity = $fetched['Quantity'];
    if(isset($_POST['btn-update']))
    {
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
                                
        mysqli_query($con, "UPDATE Sales SET CustomerName = '$customer_name', ItemID = '$item_id', ItemName = '$item_name', Country ='$country', Quantity = '$quantity', Price = '$price', SalesDate = '$sales_date' WHERE SalesID = '$id'");
        
        echo "
        <!DOCTYPE html>
        <script>
        function redir()
        {
        alert('You have editted a record.');
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
    
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <h1>Edit Sales</h1>
            
            </div>
        </div>
        
        <div class="row">
            <div class="col-xs-12">
                <form method="post">

                <div class="form-group">
                    <label for="custName">Customer Name:</label>
                    <input type="text" name="customer_name" class="form-control" value="<?php echo $fetched['CustomerName']; ?>" required/>
                </div>    

                <div class="form-group">
                    <label for="itemName">Item Purchased:</label>
                    <?php require_once "database.php";

                        $result = mysqli_query($con, "SELECT * FROM Items");

                        echo "<select name='item_name' class='form-control'>";
                        while ($row = mysqli_fetch_array($result)) 
                        {
                            echo "<option value='" . $row['ItemID'] . "'";
                            if($fetched['ItemID']==$row['ItemID'])
                            {
                                echo "selected='selected'>". $row['ItemID'] . " - " . $row['ItemName'] ."</option>";
                            }
                            else
                            {
                                echo ">". $row['ItemID'] . " - " . $row['ItemName'] ."</option>";
                            }
                        }
                        echo "</select>";
                    ?>

                </div>

                <div class="form-group">
                    <label for="Country">Country:</label>
                    <select name="country_name" class="form-control">
                        <option value='Malaysia' <?php if($fetched['Country']=="Malaysia") echo 'selected="selected"'; ?> >Malaysia</option>
                        <option value='Thailand' <?php if($fetched['Country']=="Thailand") echo 'selected="selected"'; ?> >Thailand</option>
                        <option value='Singaore' <?php if($fetched['Country']=="Singapore") echo 'selected="selected"'; ?> >Singapore</option>
                        <option value='Phillipines' <?php if($fetched['Country']=="Phillipines") echo 'selected="selected"'; ?> >Phillipines</option>
                        <option value='Vietnam' <?php if($fetched['Country']=="Vietnam") echo 'selected="selected"'; ?> >Vietnam</option>
                        <option value='Other' <?php if($fetched['Country']=="Other") echo 'selected="selected"'; ?> >Other</option>
                    </select>
                </div>




                <div class="form-group">
                    <label for="Quantity">Quantity:</label>
                    <input type="text" name="item_quantity" class="form-control" value="<?php echo $fetched['Quantity']; ?>" required/>
                </div>   

                <div class="form-group">
                    <label for="itemPrice">Total Price (MYR):</label>
                    <input type="text" name="item_price" class="form-control" value="<?php echo $fetched['Price']; ?>"required/>
                </div>


                <div class="form-group">
                    <label for="dateSold">Date:</label>         
                    <input type='text' name="sales_date" class="form-control" placeholder="yyyy/mm/dd"value="<?php echo $fetched['SalesDate']; ?>"/>

                </div>


                <div class="form-group">
                    <button type="submit" name="btn-update" class="btn btn-primary">Update</button>
                    <a href="index.php" class="btn btn-primary">Cancel</a>
                </div>


                </form>
            </div>
        </div>
    </div>
    </body>
</html>

