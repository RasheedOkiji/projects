<?php
/*
	appointments.php
	John Marshall
*/
    session_start();
?>

<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Requests</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="channel.css" />
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
					<h2>Service Requests</h2>
				</div>

<?php
			if (!$_SESSION['artist']) {
				//////////////////////////////////////////////////////////
				//no artist selected, show user a list of pending requests
				//////////////////////////////////////////////////////////
				include("connect_db.php");
				
				$user_id = $_SESSION['id'];
				
				//query for all requests initiated by this user
				$constructed_query = "SELECT * FROM request WHERE (user_id='".$user_id."')";

				$result = mysql_query($constructed_query);
				if (!$result) {
					print("Error - query could not be executed");
					print "<p>".mysql_error()."</p>";
					exit;
				} else { //success!
				
				
?>
				<div>
					<div class="table_large">
						<table>
							<tr>
								<th>Artist Name</th>
								<th>Style</th>
								<th>Area</th>
								<th>Description</th>
								<th>Quote</th>
								<th>Status</th>
							</tr>
						
<?php
					$rows = mysql_num_rows($result);
					$rows_minus = 0;//store how many rows to subtract from total when appointments found
					while ($row = mysql_fetch_assoc($result)) {
						$req_id = $row['req_id'];
						$artist_id = $row['artist_id'];
						
						$artist_query = "SELECT * FROM user WHERE (user_id='".$artist_id."')";
						
						$art_result = mysql_query($artist_query);
						if (!$art_result) {
							print("Error - query could not be executed");
							print "<p>".mysql_error()."</p>";
							exit;
						}
						
						$art_row = mysql_fetch_assoc($art_result);
						
						$artist_name = $art_row['firstname']." ".$art_row['lastname'];
						$style = $row['tattoostyle'];
						$area = $row['tattooarea'];
						$desc = $row['description'];
						$quote = $row['quote'];
						$appt = $row['appointment'];
						$Adate = $row['date'];
						$time = $row['time'];
						
						if (!$appt) {//if the request has not been completed into an appointment yet
							echo "<tr>";
							echo "	<td><a href='profile.php?artist=".$artist_id."'>".$artist_name."</a></td>";
							echo "	<td>".$style."</td>";
							echo "	<td>".$area."</td>";
							echo "	<td>".$desc."</td>";
							//if quote is null, then artist has not yet responded, otherwise they have
							if ($quote == null) {
								echo "<td>N/A</td>";
								echo "<td>Pending...</td>";
							} else {
								echo "<td>$".$quote."</td>";
								echo "<td><a href='quote.php?confirm=".$req_id."'>confirm</a> / <a href='quote.php?reject=".$req_id."'>reject</a></td>";
								echo "<td>".$Adate."</td>";
								echo "<td>".$time."</td>";
								
							}
							echo "</tr>";
						} else {
							$rows_minus++;
						}
					}
?>

						</table>
<?php
					if ($rows == 1) {
						echo $rows-$rows_minus." request found.";
					} else {
						echo $rows-$rows_minus." requests found.";
					}
?>
					</div>
				</div>
				
				<div class="title">
					<h2>Appointments</h2>
				</div>
				
				<div>
					<div class="table_large">
						<table>
							<tr>
								<th>Artist Name</th>
								<th>Date</th>
								<th>Time</th>
								<th>Comment</th>
							</tr>
							
<?php
				//query for all appointments for this user
				$constructed_query = "SELECT * FROM appointment A, request R WHERE A.req_id = R.req_id and  A.user_id='".$user_id."'";

				$result = mysql_query($constructed_query);
				if (!$result) {
					print("Error - query could not be executed");
					print "<p>".mysql_error()."</p>";
					exit;
				}
				$rows = mysql_num_rows($result);
				while ($row = mysql_fetch_assoc($result)) {
					$appt_id = $row['appt_id'];
					$req_id = $row['req_id'];
					$artist_id = $row['artist_id'];
					$Adate = $row['date'];
					$time = $row['time'];
					
					$artist_query = "SELECT * FROM user WHERE (user_id='".$artist_id."')";
					
					$art_result = mysql_query($artist_query);
					if (!$art_result) {
						print("Error - query could not be executed");
						print "<p>".mysql_error()."</p>";
						exit;
					}
					
					$art_row = mysql_fetch_assoc($art_result);
					
					$artist_name = $art_row['firstname']." ".$art_row['lastname'];
					$date = "";//fill in when we implement javascript
					
					echo "<tr>";
					echo "	<td><a href='profile.php?artist=".$artist_id."'>".$artist_name."</a></td>";
					echo "	<td>".$Adate."</td>";
					echo "	<td>".$time."</td>";
					echo "	<td><a href='review.php?appt=".$appt_id."&artist=".$artist_id."'>write review</a></td>";
					echo "</tr>";
				}
?>

						</table>
<?php
					if ($rows == 1) {
						echo $rows." appointment found.";
					} else {
						echo $rows." appointments found.";
					}
?>
					</div>
				</div>
<?php
				}
			} else {
			////////////////////////////////////////
			//else, user is an artist
			//show the artist a list of requests
			////////////////////////////////////////
				include("connect_db.php");
				
				$user_id = $_SESSION['id'];
				
				//query for all requests initiated by this user
				$constructed_query = "SELECT * FROM request WHERE (artist_id='".$user_id."')";

				$result = mysql_query($constructed_query);
				if (!$result) {
					print("Error - query could not be executed");
					print "<p>".mysql_error()."</p>";
					exit;
				}
?>
				<div>
					<div class="table_large">
						<table>
							<tr>
								<th>Requested By</th>
								<th>Style</th>
								<th>Area</th>
								<th>Description</th>
								<th>Status</th>	
							</tr>
<?php
				$rows = mysql_num_rows($result);
				$rows_minus = 0;//store hwow many rows to subtract from total when appointments found
				while ($row = mysql_fetch_assoc($result)) {
					$requester_id = $row['user_id'];
					
					$requester_query = "SELECT * FROM user WHERE (user_id='".$requester_id."')";
					
					$req_result = mysql_query($requester_query);
					if (!$req_result) {
						print("Error - query could not be executed");
						print "<p>".mysql_error()."</p>";
						exit;
					}
					
					$req_row = mysql_fetch_assoc($req_result);
					
					$requester_name = $req_row['firstname']." ".$req_row['lastname'];
					
					$req_id = $row['req_id'];
					$style = $row['tattoostyle'];
					$area = $row['tattooarea'];
					$quote = $row['quote'];
					$desc = $row['description'];
					$appt = $row['appointment'];
					
					if (!$appt) {//if the request has not been completed into an appointment yet
						echo "<tr>";
						echo "	<td>".$requester_name."</td>";
						echo "	<td>".$style."</td>";
						echo "	<td>".$area."</td>";
						echo "	<td>".$desc."</td>";
						//if quote is null, then artist has not yet responded, otherwise they have
						if ($quote == null) {
							echo "<td><a href='quote.php?req=".$req_id."'>give quote</a></td>";
						} else {
							
							echo "<td>Pending...</td>";
						}
						echo "</tr>";
					} else {
						$rows_minus++;
					}
				}
?>

						</table>
<?php
				if ($rows == 1) {
					echo $rows-$rows_minus." request found.";
				} else {
					echo $rows-$rows_minus." requests found.";
				}
?>
					</div>
				</div>
				
				<div class="title">
					<h2>Appointments</h2>
				</div>
				
				<div>
					<div class="table_large">
						<table>
							<tr>
								<th>Client Name</th>
								<th>Date</th>
								<th> time</th>
							</tr>
							
<?php
				//query for all appointments for this ARTIST
				$constructed_query = "SELECT * FROM appointment A, request R WHERE A.req_id = R.req_id and  A.artist_id='".$user_id."'";

				$result = mysql_query($constructed_query);
				if (!$result) {
					print("Error - query could not be executed");
					print "<p>".mysql_error()."</p>";
					exit;
				}
				$rows = mysql_num_rows($result);
				while ($row = mysql_fetch_assoc($result)) {
					$req_id = $row['req_id'];
					$client_id = $row['user_id'];
					$Adate = $row['date'];
					$time = $row['time'];
					
					$client_query = "SELECT * FROM user WHERE (user_id='".$client_id."')";
					
					$client_result = mysql_query($client_query);
					if (!$client_result) {
						print("Error - query could not be executed");
						print "<p>".mysql_error()."</p>";
						exit;
					}
					
					$client_row = mysql_fetch_assoc($client_result);
					
					$client_name = $client_row['firstname']." ".$client_row['lastname'];
					$date = "";//fill in when we implement javascript
					
					echo "<tr>";
					echo "<td>".$client_name."</td>";
					echo "<td>".$Adate."</td>";
					echo "<td>".$time."</td>";
					echo "</tr>";
				}
?>
						</table>
<?php
					if ($rows == 1) {
						echo $rows." appointment found.";
					} else {
						echo $rows." appointments found.";
					}
?>
					</div>
				</div>
<?php
				}
			
		
?>
			</div>
		</div>
	</body>
</html>