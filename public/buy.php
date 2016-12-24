<?php

    // configuration
    require("../includes/config.php"); 
	//require("../includes/mail.php"); 
//require_once("libphp-phpmailer/class.phpmailer.php");
    // render portfolio
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	if(!preg_match("/^\d+$/", $_POST["shares"]))
	{apologize("please enter correct amount, in positve.");}
	else{	
	$k=strtoupper($_POST["symbol"]);
	$shares=$_POST["shares"];
	//$rows=query("SELECT shares FROM holdings WHERE id=? AND symbol='$k'",$_SESSION["id"]);
	//$rows2=query("DELETE FROM holdings WHERE id = ? AND symbol='$k'",$_SESSION["id"]);
	$rows2=query("SELECT cash FROM users WHERE id=?",$_SESSION["id"]);
	
	foreach($rows2 as $row)	
	{$cash=$row["cash"];}
	$stock = lookup($_POST["symbol"]);
	$money=$shares*$stock["price"];
	// if ($stock !== false)
	
	
	
	if(($cash-$money)<0)
	{
		apologize("not enough money");	
	}
	else
	{	//$t=new DateTime();
		$st=$stock["price"];
		$d="BUY";
		$rows=query("INSERT INTO holdings (id, symbol, shares) VALUES(?, '$k', '$shares') ON DUPLICATE KEY UPDATE shares = shares + $shares",$_SESSION["id"]);
		$q=query("INSERT INTO history (id,transaction,time,symbol,shares,price) VALUES(?, '$d',NOW(),'$k','$shares','$st')",$_SESSION["id"]);

		if($rows===false)
	{ apologize("not able to insert");
	}
		/*$positions = [];
		$cash=[];
		//foreach($rows as $row)
		{
		    $stock = lookup($_POST["symbol"]);
		   
		    {	
			$positions[] = [
			    "name" => $stock["name"],
			    "price" => $stock["price"],
			    "shares" => $row["shares"],
			    "symbol" => $row["symbol"],
				
			];
			$money=$shares*$stock["price"];
		    }
			
		}*/
	$q=query("UPDATE users SET cash=cash-'$money' WHERE id = ?",$_SESSION["id"]);
//foreach($rows2 as $row){$cash[]=[ "cash"=>$row["cash"]];
				
	}
redirect("index.php");
	//render("sell_form.php", ["positions" => $positions, "title" => "Portfolio"]);
	
}}
	
else
{		//render("sell_form.php", ["positions" => $positions,"title" => "Portfolio"]);
/*		
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
				
	}*/

	render("buy_form.php", ["title" => "Portfolio"]);
}



?>
