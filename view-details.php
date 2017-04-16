<form method="post" action="">

<div class="form-group">
    <label for="custName">Customer Name:</label>
    <input type="text" id="CustomerName" name="CustomerName" class="form-control" data-ng-model="Item.name"/>
</div>    
    
<div class="form-group">
    <label for="itemName">Item Purchased:</label>
    <select name="itemName" id="itemName" name="ItemName" class="form-control" data-ng-model="Item.item">
        <option value="drug1">Acetaminophen</option>
        <option value="drug2">Adderall</option>
        <option value="drug3">Alprazolam</option>
        <option value="drug4">Amitriptyline</option>
        <option value="drug5">Amoxicillin</option>
        <option value="drug6">Ativan</option>
        <option value="drug7">Ciprofloxacin</option>
        <option value="drug8">Citalopram</option>
        <option value="drug9">Doxycycline</option>
        <option value="drug10">Gabapentin</option>
        <option value="drug11">Hydrochlorothiazide</option>
        <option value="drug12">Ibuprofen</option>
        <option value="drug13">Lexapro</option>
        <option value="drug14">Metformin</option>
        <option value="drug15">Condom/Lube</option>
        <option value="drug16">Viagra</option>
        <option value="drug17">Xanax</option>
        <option value="drug18">Zoloft</option>
    </select>
</div>

<div class="form-group">
    <label for="Country">Country:</label>
    <select name="itemName" id="Country" name="Country" class="form-control" data-ng-model="Item.country">
        <option value="country1">Malaysia</option>
        <option value="country2">Singapore</option>
        <option value="country3">Thailand</option>
        <option value="country4">Philipines</option>
        <option value="country5">Vietnam</option>
        <option value="country6">Foreign</option>
    </select>
</div>



    
<div class="form-group">
    <label for="Quantity">Quantity:</label>
    <input type="text" id="Quantity" name="Quantity" class="form-control" data-ng-model="Item.quantity"/>
</div>   

<div class="form-group">
    <label for="itemPrice">Total Price (MYR):</label>
    <input type="text" id="Price" name="Price" class="form-control" data-ng-model="Item.price"/>
</div>

<div ng-controller="dateTimeController">      
            <div class="form-group">
                <label for="dateSold">Date:</label>
                <div class='input-group date' >
                <input type='text' name="SalesDate" class="form-control" placeholder="dd/mm/yyyy" data-ng-model="Item.date"/>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
            </div>

            </div>
    
</div>    
    
<div class="form-group">
    <button ng-click="saveStuff()" class="btn btn-primary">Save</button>
    <button ng-click="cancelStuff()" class="btn btn-primary">Cancel</button>
</div>
    
    
</form>