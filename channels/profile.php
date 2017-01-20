<?php
/*
	profile.php
	Rashid Okiji
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
<?php
				if (isset($_GET['artist'])) {
					$artist_id = $_GET['artist'];
					
					include("connect_db.php");
					
					$constructed_query = "SELECT * FROM profile WHERE artist_id='$artist_id'";
					$result = mysql_query($constructed_query);
					
					$rows = mysql_num_rows($result);
					if ($rows == 1) {
						$row_array = mysql_fetch_array($result);
						$background = $row_array['background'];
					}
					
					$artist_query = "SELECT * FROM user WHERE user_id='$artist_id'";
					$artist_result = mysql_query($artist_query);
					
					$rows = mysql_num_rows($result);
					if ($rows == 1) {
						$art_array = mysql_fetch_array($artist_result);
						$first = $art_array['firstname'];
						$last = $art_array['lastname'];
					}
					
					$feedback_query = "SELECT * FROM feedback WHERE artist_id='$artist_id'";
					$feedback_result = mysql_query($feedback_query);
					
					$reviews = mysql_num_rows($feedback_result);
					$stars = 0;
					while ($fb_row = mysql_fetch_assoc($feedback_result)) {
						$stars += $fb_row['rating'];
						//grab last feedback
						$fb_rating = $fb_row['rating'];
						$fb_comment = $fb_row['feedback'];
					}
					
					
					if ($reviews > 0) {//avoid division by zero
						$average = $stars / $reviews;
					} else {
						$average ="N/A";
					}
?>
			
				<div class="title">
					<h2><?php echo $first." ".$last; ?>'s Profile</h2>
				</div>

				<div>
					<img class= "pic" src="images/pic1.jpg" alt="Channel" />
				
					<p>
						<br /><br /><br />
						<?php echo $background; ?>
						<br /><br /><br />
						<a href='request.php?artist=<?php echo $artist_id; ?>'>Request Service From <?php echo $first; ?></a>
					</p>
					<br /><br /><br /><br /><br />
				<?php if (isset($fb_rating)) { ?>
					<div class="title">
						<h2>Reviews</h2>
					</div>
					
					<p>
						<blockquote class="feedback"><span><?php echo $fb_comment; ?></span></blockquote>
						<div class="author">
						Rating: <?php echo $fb_rating; ?>/5 Stars</br>
							- User
						</div>
					</p>
				<?php } ?>
				</div>

<?php
				}
?>
			</div> 
		</div>	
	</body>
</html>