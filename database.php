<?php
$connect=mysql_connect('localhost', 'root', '');
                        

if(mysqli_connect_errno($connect))
{
     echo 'Failed to connect';
}
                    
mysql_select_db('phpsres', $connect);

?>