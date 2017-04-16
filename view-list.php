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
                    <tr data-ng-repeat="item in data | filter:search">
                        <td>{{item.id}}</td>
                        <td>{{item.name}}</td>
                        <td>{{item.item}}</td>
                        <td>{{item.country}}</td>
                        <td>{{item.quantity}}</td>
                        <td>{{item.price}}</td>
                        <td>{{item.date}}</td>
                        
                        <td style="border:none" class="glyphicon glyphicon-edit" data-ng-click="editSales($index)">
                    
                        </td>
                        <td style="border:none" class="glyphicon glyphicon-trash" data-ng-click="delSales($index)">
                        </td>
                    </tr>
                   
                </table>
<div class="form-group">
    <button data-ng-click="addSales()" class="btn btn-primary">Add Sales</button>
</div>