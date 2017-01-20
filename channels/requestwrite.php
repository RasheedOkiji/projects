<?php
/*
	request.php
	John Marshall
*/
    session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Request Form</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="channel.css" />
	</head>
	<body>
	<?php
	//connect to mysql database
		include("connect_db.php");
	
		$Aid = $_POST['artist_id'];
		$Uid = $_SESSION['id'];
		
		$firstname = $_SESSION['firstname'];
		
		$style = $_POST['tat_style'];
		$area = $_POST['tat_area'];
		$desc = $_POST['tat_description'];
		$pic = $_POST['fileupload'];

		$insert_query = "INSERT INTO request (artist_id, user_id, tattoostyle, tattooarea, description) 
							VALUES ('".$Aid."', '".$Uid."', '".$style."', '".$area."', '".$desc."')";
	#Execute query
	$store = mysql_query($insert_query);
		
		if(! $store){
		print("Error - query could not be executed");
		$error = mysql_error();
		print "<p> . $error . </p>";
		exit;
	}	
	
?>
		<div class="container">

			<div class="banner">
				<img src="images/logo.png" alt="Channel" class="logopic" />hannel
				<span class="login">
                    <?php
						include("head.php");
                    ?>
				</span>
			</div>

			<div class="menu">
				<?php
					include("menu.php");
				?>
			</div>
			
			<div class="content">
				<div class="title">
					<h2>Service Request</h2>
				</div>
				<br />
				<div>
					<p>
					 Your request has been submitted.
					View all of your pending requets <a href="appointments.php" >HERE</a>
					</p>
				</div>
			</div>
		</div>
	</body>
</html>