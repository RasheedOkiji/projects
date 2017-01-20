<?php
/*
	createAccount.php
	Rasheed Okiji
*/
    session_start();
?>

<?xml version = "1.0" encoding = "utf-8"?>
<!DOCTYPE html PUBLIC "-//w3c//DTD XHTML 1.1//EN"
  "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
	
<!-- add-numbers.html 
      Asks user to enter three numbers and computes the sum
     -->
<html xmlns = "http://www.w3.org/1999/xhtml">
<head>
    <title>Create Account</title>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <link rel="stylesheet" type="text/css" href="channel.css"/>   
</head>
<body>
   
     <?php
    $db = mysql_connect("studentdb-maria.gl.umbc.edu","ryaffe1","ryaffe1");
    
    if(!$db)
		exit("Error - could not connect to MySQL");

	#select database rokiji1
	$er = mysql_select_db("ryaffe1");
	if(!$er)
		exit("Error - could not select the database");

	#get the parameter from the HTML form that this PHP program is connected to
	#since data from the form is sent by the HTTP POST action, use the $_POST array here

	$firstName = mysql_real_escape_string(htmlspecialchars($_POST['fname']));
    $lastName = mysql_real_escape_string(htmlspecialchars($_POST['lname']));
    $email = mysql_real_escape_string(htmlspecialchars($_POST['email']));
    $username = mysql_real_escape_string(htmlspecialchars($_POST['uname']));
    $password1 = mysql_real_escape_string(htmlspecialchars($_POST['mypass1']));
    $password2 = mysql_real_escape_string(htmlspecialchars($_POST['mypass2']));
    $street = mysql_real_escape_string(htmlspecialchars($_POST['ustreet']));
    $city = mysql_real_escape_string(htmlspecialchars($_POST['ucity']));
    $zipcode = mysql_real_escape_string(htmlspecialchars($_POST['uzipcode']));
    $state = mysql_real_escape_string(htmlspecialchars($_POST['ustate']));
    $artist = mysql_real_escape_string(htmlspecialchars($_POST['artist']));
	$background = mysql_real_escape_string(htmlspecialchars($_POST['background']));
    
    //validate all the inputs with javascript


    //check wether the user has already registered 
    $select_query = "select * from user where username='$username'";
    $select_result = mysql_query($select_query);

    //$select_num = mysql_num_rows($select_result);
    //echo "here1";
    if(!$select_result)
    {
        print("Error - query could not be executed");
        print "<p>.$error.</p>";
    }
    
    //check the number of the username on the database
    $num_rows = mysql_num_rows($select_result);

    if($num_rows == 1) {
        //echo "not empty <br />";
        //username already exist 
        //use javascript to alert the user to choose a different username
        //echo "Username already exist Please select another username <br />";
        header("location: createAccount.html"); //redirect to the create account page
        
        
    } else {
        $constructed_query = "INSERT INTO user (firstname,lastname,email,username,password,street,city,zipcode,state,artist) VALUES ('$firstName','$lastName','$email','$username','$password1','$street','$city','$zipcode','$state','$artist')";
    
        $result = mysql_query($constructed_query);  
        if (!$result) {
			echo ("Error - query could not be executed");
			$error = mysql_error();
			echo "<p>$error</p>";
			exit;
        }
		
		if ($artist) {//create artist profile
			//get the artist's newly assigned id
			$artist_query = "SELECT user_id FROM user WHERE username='$username'";
			$artist_result = mysql_query($artist_query);  
			if (!$artist_result) {
				echo ("Error - query could not be executed");
				$error = mysql_error();
				echo "<p>$error</p>";
				exit;
			}
			
			
			$row = mysql_fetch_assoc($artist_result);
			$artist_id = $row['user_id'];
			
			//insert new profile into table
			$profile_query = "INSERT INTO profile (artist_id, background) VALUES ('$artist_id', '$background')";
			$profile_result = mysql_query($profile_query);  
			if (!$result) {
				echo ("Error - query could not be executed");
				$error = mysql_error();
				echo "<p>$error</p>";
				exit;
			}
		}
        
        //send email to the new user -- dont have mail server though
/*         $message = "Congratulations, You have successfull created an account with Channel.
                    To access your account, follow this link <a href=https://swe.umbc.edu/~rokiji1/is448/project/login.php
                     
                     If you have any question, feel free to contact us at rokiji1@umbc.edu
                     
                     Rasheed Okiji
                     Channel";
        mail($email, "ryaffe1", $message, "From: rasheed <rokiji1@umbc.edu>"); */

        header("location: login.html"); // Redirecting To Other Page
    }
    ?>
</body>
</html>