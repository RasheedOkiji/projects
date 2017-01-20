<?php
/*
	logout.php
	Whitney Ikpeze
*/
	session_start();
	if(session_destroy()) { //destroy session and session vars
		header("Location: index.php"); //redirect to index
	}
?>