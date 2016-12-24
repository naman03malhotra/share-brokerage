<div>
	<div id="middle">
    <table class="table table-striped">
    <?php
	print("<center>");
	print("<thead>");
	 print("<tr>");
		print("<th>symbol:</th>");
		print("<th>Shares:</th>");
		print("<th>price:</th>");
		print("<th>Total:</th>");
	print("</tr>");
	print("</thead>");
	print("<tbody>");
	print("</center>");
        foreach ($positions as $position)
        {
            print("<tr>");
		
            print("<td>" . $position["symbol"] . "</td>");

            print("<td>" . $position["shares"] . "</td>");

            print("<td>" . "$".$position["price"] . "</td>");
		 print("<td>"."$". $position["price"]* $position["shares"]. "</td>");
            print("</tr>");
        }
	print("</tbody>");
	foreach ($cash as $cash){print("<th>cash:</th>");
            print("<td>" ."$". $cash["cash"] . "</td>");}
    ?>
</table>
</div>
</div>
<div>
    <a href="logout.php">Log Out</a>
</div>
