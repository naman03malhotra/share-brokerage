<?php

    // configuration
    require("../includes/config.php"); 

    // render portfolio
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$k=strtoupper($_POST["symbol"]);
	$rows=query("SELECT shares FROM holdings WHERE id=? AND symbol='$k'",$_SESSION["id"]);
	$rows2=query("DELETE FROM holdings WHERE id = ? AND symbol='$k'",$_SESSION["id"]);	
	if($rows!==false)
	{ 
		$positions = [];
		$cash=[];
		foreach($rows as $row)
		{
		    $stock = lookup($_POST["symbol"]);
		    if ($stock !== false)
		    {	
			/*$positions[] = [
			    "name" => $stock["name"],
			    "price" => $stock["price"],
			    "shares" => $row["shares"],
			    "symbol" => $row["symbol"],
				
			];*/
			$money=$row["shares"]*$stock["price"];
		    }
			
		}
	$st=$stock["price"];$d="SELL";
	$shares=$row["shares"];
	$q=query("UPDATE users SET cash=cash+'$money' WHERE id = ?",$_SESSION["id"]);
	$q=query("INSERT INTO history (id,transaction,time,symbol,shares,price) VALUES(?, '$d',NOW(),'$k','$shares','$st')",$_SESSION["id"]);
//foreach($rows2 as $row){$cash[]=[ "cash"=>$row["cash"]];
				
	}

	redirect("index.php");//render("sell_form.php", ["positions" => $positions, "title" => "Portfolio"]);
}
	
else
{		//render("sell_form.php", ["positions" => $positions,"title" => "Portfolio"]);
		
	$rows=query("SELECT symbol FROM holdings WHERE id=?",$_SESSION["id"]);
	//$rows2=query("SELECT cash FROM users WHERE id=?",$_SESSION["id"]);	
	if($rows!==false)
	{ 
		$positions = [];
		//$cash=[];
		foreach($rows as $row)
		{
		    $stock = lookup($row["symbol"]);
		    if ($stock !== false)
		    {	
			$positions[] = [
			    
			    "symbol" => $row["symbol"]
				
			];
		    }
			
		}
//foreach($rows2 as $row){$cash[]=[ "cash"=>$row["cash"]];
				
	}

	render("sell_form.php", ["positions" => $positions, "title" => "Portfolio"]);
}



?>
