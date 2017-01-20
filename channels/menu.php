<?php
/*
	menu.php
	Robert Yaffe
*/
	
	//if user is logged in, display the full menu
	if (isset($_SESSION['id'])) {
?>
				<ul>
					<li><a href="index.php">HOME</a></li>
<?php
					if (!$_SESSION['artist']) {
						echo "<li><a href='search.php'>SEARCH</a></li>";
					}
?>
					<li><a href="appointments.php">APPOINTMENTS</a></li>
				</ul>				
<?php
	//otherwise, display a minimal menu
	} else {
?>
				<ul>
					<li><a href="index.php">HOME</a></li>
				</ul>	
<?php		
	}
?>