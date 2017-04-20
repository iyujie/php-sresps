<?php include 'database.php';


$id = $_GET['id'];
$query = "SELECT FROM Sales WHERE SalesID='$id'"; 
                        $result = mysql_query($query);

                        if (!$result) { 
                            die('Invalid query: ' . mysql_error());
                        }else
                        {
                            $fetched=mysql_fetch_array($result);
                            if(isset($_POST['btn-update']))
                            {
                                $customer_name=$_POST['CustomerName'];
                                $item_id=$_POST['ItemName'];
                                //retrieve
                                $item_name = mysql_query("SELECT ItemName FROM Items WHERE ItemID = '$item_id");
                                $country=$_POST['Country'];
                                $quantity=$_POST['Quantity'];
                                $price=$_POST['Price'];
                                $sales_date=$_POST['SalesDate'];
                                
                                mysql_query("UPDATE Sales SET CustomerName = '$customer_name', ItemID = '$item_id', ItemName = '$item_name',  
                                Country ='$country', Quantity = '$quantity', Price = '$price', SalesDate = '$sales_date' WHERE SalesID = '$id'");
                            }
                        }
                

                        

                        mysql_close(); 

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

?>



<form method="post">

<div class="form-group">
    <label for="custName">Customer Name:</label>
    <input type="text" name="CustomerName" class="form-control" value="<?php echo $fetched['CustomerName']; ?>" required/>
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
    <button type="submit" name="btn-update" class="btn btn-primary">Save</button>
    <button ng-click="cancel()" class="btn btn-primary">Cancel</button>
</div>
    
    
</form>
       
