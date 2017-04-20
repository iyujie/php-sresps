<?php include 'database.php';


//submit
if(isset($_POST['btn-submit']))
{
    $customer_name=$_POST['CustomerName'];
    $item_id=$_POST['ItemName'];
    //retrieve
    $item_name = mysql_query("SELECT ItemName FROM Items WHERE ItemID = '$item_id");
    $country=$_POST['Country'];
    $quantity=$_POST['Quantity'];
    $price=$_POST['Price'];
    $sales_date=$_POST['SalesDate'];
    
    mysql_query("INSERT INTO Sales(SalesID,CustomerName,ItemID,ItemName,Country,Quantity,Price,SalesDate)
                    VALUES (NULL, '$customer_name','$item_id','$item_name','$country','$quantity', '$price', '$sales_date')");

    mysql_query("UPDATE Items SET StockLeft = StockLeft - '$quantity' WHERE ItemID = '$item_id'");


    //check stock after each record add
    $stockchecker=mysqli_query($connect,"SELECT ItemName FROM Items WHERE StockLeft <= 5");
    if($stockchecker != NULL)
    {
        $message = $stockchecker + "is running out of stock!";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
            
            
    
    mysql_close(); 
            
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
//Execute the query
//mysqli_query($connect,"INSERT INTO Sales(SalesID,CustomerName,ItemID,Country,Quantity,Price,SalesDate)
//		        VALUES (NULL, '$customer_name','$item_id','$country','$quantity', '$price', '$sales_date'); 
//              UPDATE Items SET StockLeft = StockLeft - '$quantity' WHERE ItemID = '$item_id'");
			
?>
		
<form method="post">

<div class="form-group">
    <label for="custName">Customer Name:</label>
    <input type="text" id="CustomerName" name="CustomerName" class="form-control" data-ng-model="Item.name" required/>
</div>    
    
<div class="form-group">
    <label for="itemName">Item Purchased:</label>
    <?php include "database.php";
        $result = mysql_query("SELECT ItemID, ItemName FROM Items");
        
        echo "<select name='ItemName' class='form-control'>";
        while ($row = mysql_fetch_array($result)) 
        {
            echo "<option value='" . $row['ItemID'] . "'>". $row['ItemID'] . " - " . $row['ItemName'] ."</option>";
        }
        echo "</select>";
    ?>
    
</div>

<div class="form-group">
    <label for="Country">Country:</label>
    <select name="Country" class="form-control">
        <option value="Malaysia">Malaysia</option>
        <option value="Thailand">Thailand</option>
        <option value="Singaore">Singapore</option>
        <option value="Phillipines">Phillipines</option>
        <option value="Vietnam">Vietnam</option>
        <option value="Other">Other</option>
    </select>
</div>



    
<div class="form-group">
    <label for="Quantity">Quantity:</label>
    <input type="text" id="Quantity" name="Quantity" class="form-control" data-ng-model="Item.quantity" required/>
</div>   

<div class="form-group">
    <label for="itemPrice">Total Price (MYR):</label>
    <input type="text" id="Price" name="Price" class="form-control" data-ng-model="Item.price" required/>
</div>

    
            <div class="form-group">
                <label for="dateSold">Date:</label>
                
                <input type='text' name="SalesDate" class="form-control" placeholder="dd/mm/yyyy" data-ng-model="Item.date"/>
            

            </div>
    
    
<div class="form-group">
    <button type="submit" name="btn-submit" class="btn btn-primary">Save</button>
    <button ng-click="cancel()" class="btn btn-primary">Cancel</button>
</div>
    
    
</form>
       
