<?php

    // configuration
    require("../includes/config.php");

	 // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
	$s=lookup($_POST["symbol"]);
		if($s===false)
		{
			apologize("Not a valid symbol.");		
		}
		else
			{
				//print_r($s);
				render("quote_disp.php", ["price" => $s["price"]]);
			}

	}
    else
    {
        // else render form
        render("quote_form.php", ["price" => @$s["price"]],["title" => "Register"]);
    }

?>
