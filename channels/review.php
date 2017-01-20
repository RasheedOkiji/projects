<?php
/*
	review.php
	Fabrice Pani
*/
    session_start();
?>

<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Review</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="channel.css" />
		<script type="text/javascript" src="review.js"></script>
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
					<h2>Leave Feedback</h2>
				</div>
				
<?php
	//if there is a submission
	if (isset($_POST['sub'])) {
		//connect to mysql database
		include("connect_db.php");

		$artist_id = $_POST["artist_id"];
		$appt_id = $_POST["appt_id"];
		$title = $_POST["title"];
		$rating = $_POST["stars"];
		$feedback = $_POST["comment"];

		$firstname = $_SESSION['firstname'];

		$constructed_query = "INSERT INTO feedback (artist_id, user_id, appt_id, rating, title, feedback)
								VALUES ('".$artist_id."', '".$_SESSION['id']."', '".$appt_id."', '".$rating."', '".$title."', '".$feedback."')";

		$result = mysql_query($constructed_query);
		if (!$result) {
			print("Error - query could not be executed");
			exit;
		} else { //success!
			echo $firstname.", thank you for your review.<br />";
			echo "Your review has been submitted.<br/>";
		}
	//if no form submission --
	} else {
		$appt_id = $_GET['appt'];
		$artist_id = $_GET['artist'];
		if (isset($appt_id) && isset($artist_id)) {
			//connect to mysql database
			include("connect_db.php");
			
			$artist_query = "SELECT * FROM user WHERE user_id='$artist_id'";
			$artist_result = mysql_query($artist_query);
			
			$rows = mysql_num_rows($artist_result);
			if ($rows == 1) {
				$art_array = mysql_fetch_array($artist_result);
				$first = $art_array['firstname'];
				$last = $art_array['lastname'];
			}
?>			
				<div>
					<form action="review.php" method="post">
						<div class="options">
							<div class="option">
								Rate <?php echo $first." ".$last; ?>'s Tattoo Work<br />
								<input type="radio" name="stars" value="1" checked="checked" />1 Star
								<input type="radio" name="stars" value = "2" />2 Stars
								<input type="radio" name="stars" value = "3" />3 Stars
								<input type="radio" name="stars" value = "4" />4 Stars
								<input type="radio" name="stars" value = "5" />5 Stars
							</div>
							<div class="option">
								Title: 
								<input type="text" name="title" />
							</div>
							<div class="option">
								Feedback:<br />
								<textarea name="comment" id="comment" placeholder="Please leave a comment about <?php echo $first; ?>!" onblur="return check();" ></textarea>
							</div>
							<div class="option">
								<input type="hidden" name="sub" />
								<input type="hidden" name="appt_id" value="<?php echo $appt_id; ?>" />
								<input type="hidden" name="artist_id" value="<?php echo $artist_id; ?>" />
								<input type="submit" value="Submit"/>
							</div>
						</div>
					</form>
				</div>
<?php
		}
	}
?>
			</div>
		</div>
	</body>
</html>