<?php
    
    $username=$_GET["uname"];
	$password=$_GET["pass"];
	
	$response = "invalid";
	
	if ($username != "" && $password != "") {
		$db = mysql_connect("studentdb-maria.gl.umbc.edu","ryaffe1","ryaffe1");
		
		if(!$db)
			exit("Error - could not connect to MySQL");

		#select database ryaffe1
		$er = mysql_select_db("ryaffe1");
		if(!$er)
			exit("Error - could not select the database");


		//check wether the user has already registered 
		$select_query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
		$select_result = mysql_query($select_query);

		//$select_num = mysql_num_rows($select_result);
		//echo "here1";
		if(!$select_result)
		{
			print("Error - query could not be executed");
			print "<p>.$error.</p>";
		}
		
		//check the number of the username on the database
		$num_rows = mysql_num_rows($select_result);
		
		
		if($num_rows == 1)
		{
			$response= "valid";
		}
		
		mysql_close($db); // Closing Connection
	}

	echo $response;
?>