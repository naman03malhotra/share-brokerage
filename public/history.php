<?php

    // configuration
    require("../includes/config.php"); 

    // render portfolio
	$rows=query("SELECT * FROM history WHERE id=?",$_SESSION["id"]);
	//$rows2=query("SELECT cash FROM users WHERE id=?",$_SESSION["id"]);	
	if($rows!==false)
	{ 
		$positions = [];
		$cash=[];
		foreach($rows as $row)
		{
		   // $stock = lookup($row["symbol"]);
		    //if ($stock !== false)
		    {	
			$positions[] = [
			    "transaction" => $row["transaction"],
			    "time" => $row["time"],
			    "symbol" => $row["symbol"],
			    "shares" => $row["shares"],
				"price" => $row["price"],
				
			];
		    }
			
		}
//foreach($rows2 as $row){$cash[]=[ "cash"=>$row["cash"]];
				
	

	render("history_form.php", ["positions" => $positions, "title" => "History"]);
	}
	else
	{render("history_form.php", ["title" => "History"]);}

?>
