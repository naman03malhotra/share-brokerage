<?php

    // configuration
    require("../includes/config.php"); 

    // render portfolio
	$rows=query("SELECT symbol,shares FROM holdings WHERE id=?",$_SESSION["id"]);
	$rows2=query("SELECT cash FROM users WHERE id=?",$_SESSION["id"]);	
	if($rows!==false){ 
		$positions = [];
		$cash=[];
		foreach($rows as $row)
		{
		    $stock = lookup($row["symbol"]);
		    if ($stock !== false)
		    {	
			$positions[] = [
			    "name" => $stock["name"],
			    "price" => $stock["price"],
			    "shares" => $row["shares"],
			    "symbol" => $row["symbol"],
				
			];
		    }
			
		}
foreach($rows2 as $row){$cash[]=[ "cash"=>$row["cash"]];
				
		}

	render("portfolio.php", ["positions" => $positions, "title" => "Portfolio","cash"=>$cash]);
	}
	else
	{render("portfolio.php", ["title" => "Portfolio"]);}

?>
