
<div id="middle">
    

	
<form action="sell.php" method="post">
    <fieldset>
        <div class="form-group">
            <select class="form-control" name="symbol">
               <? foreach ($positions as $position) 
		{ print("<option>" . $position["symbol"] . "</option>");}?>
                            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Sell</button>
        </div>
    </fieldset>
</form>
   


</div>
<div>
    <a href="logout.php">Log Out</a>
</div>
