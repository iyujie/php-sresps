<div class="form-group">
    <input type="text" class="form-control" id="search" placeholder="Search item, customer, etc" data-ng-model="search">
</div>
                <table class="table table-stripped table-hover">
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

                        $query = "SELECT * FROM phpsres.Sales"; 
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
                                echo "<td><a href=\"edit.php?id=". $row['SalesID'] ."\"><strong>Edit</strong></td>";
                                echo "<td><a href=\"delete.php?id=". $row['SalesID'] ."\"onclick=\"return confirm('Are you sure to delete this?');\"><strong>Delete</strong>";
                                echo "</tr>";  

                            }
                        }

                        

                        mysql_close(); 
                    
                    ?>
                   
                </table>
<div class="form-group">
    <button data-ng-click="addSales()" class="btn btn-primary">Add Sales</button>
</div>
    