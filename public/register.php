<?php

    // configuration
    require("../includes/config.php");

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["confirmation"]))
		{
			apologize("Please fill all the feilds");		
		}
	
			else if($_POST["password"]!=$_POST["confirmation"])
				{
					apologize("Password Do not match, try again");
				}
         	
	else{
		
			$q=query("INSERT INTO users (username, hash, cash) VALUES(?, ?, 10000.00)", $_POST["username"], crypt($_POST["password"]));	
			if($q===false)
				{
				    apologize("User already exists, try a different one.");
				}	

			else
				{
					$rows = query("SELECT LAST_INSERT_ID() AS id");
					$id = $rows[0];	
					$_SESSION["id"]=$id["id"];
					redirect("index.php");			
				}
		}
    }
    else
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

?>
