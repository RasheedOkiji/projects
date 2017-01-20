<?php
/*
	request.php
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
						$artist_id = $_GET['artist'];
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
					<form method="post" name="request" action="requestwrite.php">
						<div class="options">
							<div class="option">
								Tattoo style: <input type="text" name="tat_style" /><br />
								Tattoo area: <input type="text" name="tat_area" />
							</div>
							<div class="option">
								Write a description: <br />
								<textarea name="tat_description" placeholder="Describe the tattoo..."></textarea>
							</div>
							<div class="option" style="display: none;">
								Upload reference photo: 
								<input type="file" name="fileupload" value="fileupload" id="fileupload" />
							</div>
							<br />
							<div class="option">
								<input type="hidden" name="sub" />
								<input type="hidden" name="artist_id" value="<?php echo $artist_id; ?>" />
								<input type="submit" value="Submit" />
								<input type="reset" value="Clear" />
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>