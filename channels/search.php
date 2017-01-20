<?php
/*
	search.php
	Robert Yaffe
*/
    session_start();
?>

<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Search Artists</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="channel.css" />
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/prototype/1.7.3.0/prototype.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/scriptaculous/1.9.0/scriptaculous.js"></script>
		<script type="text/javascript" src="search.js"></script>
	</head>
	<body onload="focusSearch();">	
		<div class="container">
		
			<div class="banner">
				<img src="images/logo.png" alt=" Channel" class="logopic" />hannel
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
					<h2>Search</h2>
				</div>
<?php
	//form submission
	if (isset($_POST['sub'])) {
		//connect to mysql database
		include("connect_db.php");
		
		$city = $_POST["city"];
		
		$constructed_query = "SELECT * FROM user WHERE (city='".$city."' AND artist='1')";

		$result = mysql_query($constructed_query);
		if (!$result) {
			print("Error - query could not be executed");
			exit;
		} else { //success!
?>
				<div>
					<div class="table">
						<table>
							<tr>
								<th>Name</th>
								<th>Location</th>
								<th>Rating</th>
								<th>Feedback</th>
							</tr>
<?php
			$rows = mysql_num_rows($result);
			while ($row = mysql_fetch_assoc($result)) {
				$artist_id = $row['user_id'];
				$artist_name = $row['firstname']." ".$row['lastname'];
				$city = $row['city'];
				
				$feedback_query = "SELECT * FROM feedback WHERE artist_id='$artist_id'";
				$feedback_result = mysql_query($feedback_query);
				
				$reviews = mysql_num_rows($feedback_result);
				$stars = 0;
				while ($fb_row = mysql_fetch_assoc($feedback_result)) {
					$stars += $fb_row['rating'];
				}
				
				if ($reviews > 0) {//avoid division by zero
					$average = round($stars / $reviews, 1);
				} else {
					$average ="N/A";
				}
				
				
				echo "<tr class='search-row' style='display:none;'>";
				//echo "	<td><a href='request.php?artist=".$artist_id."'>".$artist_name."</a></td>";
				echo "	<td><a href='profile.php?artist=".$artist_id."'>".$artist_name."</a></td>";
				echo "	<td>".$city."</td>";
				echo "	<td>".$average."</td>";
				echo "	<td>".$reviews." Reviews</td>";
				echo "</tr>";
			}
		}
?>

						</table>
<?php
		if ($rows == 1) {
			echo $rows." artist found in ".$city.".";
		} else {
			echo $rows." artists found in ".$city.".";
		}
?>
					</div>
				</div>
<?php	
	//regular page load
	} else {
?>
				<div>
					<form action="search.php" method="post">
						<div class="options">
							<div class="option">
								City: 
								<input type="text" name="city" id="city" onkeyup="showHint(this.value)" onfocus="showHint(this.value)" onblur="setTimeout(clearHint, 500);" autocomplete="off" />
								<div id="hint" style="display:none;">
								</div>
							</div>
							<div class="option">
								<input type="hidden" name="sub" />
								<input type="submit" value="Submit"/>
							</div>
						</div>
					</form>
				</div>
<?php
	}
?>
			</div>
		</div>
	</body>
</html>