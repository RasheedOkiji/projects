<?php
/*
	login.php
	Whitney Ikpeze
*/
	session_start(); //open session
	$error=''; //Variable To Store Error Message
	
	if (isset($_POST['submit'])) {
		if (!empty($_POST['username']) && !empty($_POST['password'])) {
			//connect to mysql server
			include("connect_db.php");
			
			//store submitted form input into $username and $password
			$username = mysql_real_escape_string(htmlspecialchars($_POST['username']));
			$password = mysql_real_escape_string(htmlspecialchars($_POST['password']));
			
			//select username and password from db
			$constructed_query = "SELECT * FROM user WHERE password='$password' AND username='$username'";
			$result = mysql_query($constructed_query); //run the query
			
			$rows = mysql_num_rows($result);
			if ($rows == 1) {
				$row_array = mysql_fetch_array($result);
				
				$id = $row_array['user_id'];			//grab user's id
				$firstname = $row_array['firstname']; //grab user's first name to personalize the experience
				$artist = $row_array['artist'];
				
				$_SESSION['id'] = $id; //stored user id means user is logged in
				$_SESSION['firstname'] = $firstname;
				$_SESSION['artist'] = $artist;
				
				header("location: index.php"); //finally, redirect to index
			} else {
				header("location: login.html"); //finally, redirect to index
			}
			mysql_close($db); // Closing Connection
		} else {
			header("location: login.html"); //finally, redirect to index
		}
	}
?>