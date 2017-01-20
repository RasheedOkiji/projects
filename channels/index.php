<?php
/*
	index.php
	Everyone
*/
    session_start();
?>

<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Home page</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="channel.css" title="style" />
	</head>
	<body>
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
					<h2>Welcome!</h2>
				</div>

				<div>
					<img class= "pic" src="images/pic1.jpg" alt="Channel" />
				
					<p>
					<br /><br /><br />
					Do you have an interest in tattoo art? Are you looking for a great
					artist in your area? <span class="strong">Channel</span> is an application that allows you to
					find quality tattoo artists in your area.
					</p>
				</div>
				<br /><br /><br /><br /><br /><br />
				<div>
					
				</div>
			</div> 
		</div>	
	</body>
</html>