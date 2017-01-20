<?php
	$input = $_GET["city"];

	$hint = "";
	$max_suggestions = 3;
	
	if (strlen($input) > 0) {
		include("connect_db.php");
		
		$constructed_query = "SELECT DISTINCT city FROM user WHERE city LIKE '".$input."%' AND artist='1'";

		$result = mysql_query($constructed_query);
		if (!$result) {
			print("Error - query could not be executed");
			exit;
		}
		
		$rows = mysql_num_rows($result);
		while ($row = mysql_fetch_assoc($result)) {
			$city = $row["city"];
			$hint = $hint."<span class='city'>$city</span><br />";
		}
		
		if ($rows == 0)
			$hint = "No matches.";
	}
	
	echo $hint;
?>