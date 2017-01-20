<?php
/*
	quote.php
	Robert Yaffe
*/
    session_start();
?>

<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Quotes</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="channel.css" />
		<script type = "text/javascript"  src = "Qvalidator.js" > </script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/prototype/1.7.3.0/prototype.js"></script>
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
					<h2>Quote</h2>
				</div>
<?php
			////////////////////////////////////////////////////////////////
			//a request is selected, allow artist to submit a quote via form
			////////////////////////////////////////////////////////////////
			if (isset($_GET['req'])) {
				$req_id = $_GET['req'];
				include("connect_db.php");
							
				$constructed_query = "SELECT * FROM request WHERE (req_id='".$req_id."')";
			
				$result = mysql_query($constructed_query);
				if (!$result) {
					print("Error - query could not be executed");
					print "<p>".mysql_error()."</p>";
					exit;
				} else { //success!
					$rows = mysql_num_rows($result);
					if ($rows == 1) {
						$row = mysql_fetch_assoc($result);
						$requester_id = $row['user_id'];
						$style = $row['tattoostyle'];
						$area = $row['tattooarea'];
						$desc = $row['description'];
						
						$requester_query = "SELECT * FROM user WHERE (user_id='".$requester_id."')";
						
						$req_result = mysql_query($requester_query);
						if (!$req_result) {
							print("Error - query could not be executed");
							print "<p>".mysql_error()."</p>";
							exit;
						}
						
						$req_row = mysql_fetch_assoc($req_result);
						
						$requester_name = $req_row['firstname']." ".$req_row['lastname'];
					}
				}
?>				
				<div>
					<form method="post" name="quote" action="quote.php">
						<div class="options">
							<div class="option">
								Requester: <?php echo $requester_name; ?>
							</div>
							<div class="option">
								Tattoo style: <?php echo $style; ?> <br />
								Tattoo area: <?php echo $area; ?>
							</div>
							<div class="option">
								Description: <br />
								<?php echo $desc; ?>
							</div>
							<div class="option">
								Quote: $<input type="text" name="quote" id="quote" onblur="qc(this.value)" />
								<br/> <span style="color:red; font-size:8pt;" id="commentQ"></span>
							</div>
							<div class="option">
								Appointment Date:<br/> <input type="text" name="date" id="date" onblur="dc(this.value)"  />
								<br/> <span style="color:red; font-size:8pt;"  id="commentD"></span><br />
							</div>
							<div class="option">
								 Appointment Time: <br/> <input type="text" name="time" id="time" onblur="tc(this.value)" />
								<br/> <span style="color:red; font-size:8pt;" id="commentT"></span><br />
							</div>
							<br />
							<div class="option">
								<input type="submit" value="Submit" onclick="return check();"  />
								<input type="hidden" name="sub" />
								<input type="hidden" name="req_id" value="<?php echo $req_id; ?>" />
								<input type="reset" value="Clear" />
							</div>
						</div>
					</form>
				</div>
				
				
<?php
			////////////////////////////
			//if a user CONFIRMS a quote
			////////////////////////////
			} else if (isset($_GET['confirm'])) {
				$req_id = $_GET['confirm'];
				include("connect_db.php");
				
				$req_query = "SELECT * FROM request WHERE (req_id='".$req_id."')";

				$result = mysql_query($req_query);
				if (!$result) {
					print("Error - query could not be executed");
					print "<p>".mysql_error()."</p>";
					exit;
				}
				$row = mysql_fetch_assoc($result);
				$user_id = $_SESSION['id'];
				$artist_id = $row['artist_id'];
				
			
				//create the appointment
				$constructed_query = "INSERT INTO appointment (artist_id, user_id, req_id) VALUES ('$artist_id', '$user_id', '$req_id')";
			
				$result = mysql_query($constructed_query);
				if (!$result) {
					print("Error - query could not be executed");
					print "<p>".mysql_error()."</p>";
					exit;
				}
				
				//set appointment boolean field to true so we dont display it in requests table
				$update_query = "UPDATE request SET appointment='1' WHERE req_id='".$req_id."'";
			
				$result = mysql_query($update_query);
				if (!$result) {
					print("Error - query could not be executed");
					print "<p>".mysql_error()."</p>";
					exit;
				}
				$firstname = $_SESSION['firstname'];
				echo $firstname.", the quote has been confirmed! Your appointment has been scheduled!";
			
			///////////////////////////
			//if a user REJECTS a quote
			///////////////////////////
			} else if (isset($_GET['reject'])) {
				//connect to mysql database
				include("connect_db.php");
				
				$req_id = $_GET['reject'];
				$_query = "DELETE FROM request WHERE req_id='".$req_id."'";
	
				#Execute query
				$appointment = mysql_query($_query);

				if(! $appointment){
				print("Error - query could not be executed");
				$error = mysql_error();
				print "<p> . $error . </p>";
				exit;
				} else {
					//request submission success!
					$firstname = $_SESSION['firstname'];
					echo $firstname.", quote has been rejected!";
				}
				
			///////////////////////////////
			//if a quote has been submitted
			///////////////////////////////
			} else if (isset($_POST['sub'])) {
				//connect to mysql database
				include("connect_db.php");

				$firstname = $_SESSION['firstname'];
				$quote = $_POST['quote'];
				$date = $_POST['date'];
				$time = $_POST['time'];
				$req_id = $_POST['req_id'];

			    $update_query = "UPDATE request SET quote='".$quote."' WHERE req_id='".$req_id."'";
				
				$update_query2 = "UPDATE request SET date='".$date."' WHERE req_id='".$req_id."'";
				
				$update_query3 = "UPDATE request SET time='".$time."' WHERE req_id='".$req_id."'";
	
				
				#Execute query
		
				$store = mysql_query($update_query);
				$store2 = mysql_query($update_query2);
				$store3 = mysql_query($update_query3);
				if(!$store) {
					print("Error - query could not be executed");
					print "<p>".mysql_error()."</p>";
					exit;
					

				} else {
					//request submission success!
					echo $firstname.", your quote has been submitted!";
				}
				
			}
?>
			</div>
		</div>
	</body>
</html>