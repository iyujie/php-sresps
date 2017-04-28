<?php require_once 'database.php';


$id = $_GET['id'];
$query = "DELETE FROM phpsres.Sales WHERE SalesID=" . $id; 
                        $result = mysqli_query($con, $query);
                        if (!$result) { 
                            die('Invalid query: ' . mysql_error());
                        }else
                        {
                            $message = "Deleted successfully";
                            echo "<script type='text/javascript'>alert('$message');</script>";
                        }

                        

                        mysql_close(); 

echo "
<!DOCTYPE html>
<script>
function redir()
{
window.location.assign('index.php');
}
</script>
<body onload='redir();'></body>";

?>

