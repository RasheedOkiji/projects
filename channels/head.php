<?php
/*
	head.php
	Robert Yaffe
*/
						if(isset($_SESSION['id'])) {//if id is stored, user is currently logged in
							$logout = "logout.php";
							$user = $_SESSION['firstname'];
							echo "<span class='firstname'>".$user."</span>";
							echo "<span class='head'><a href='".$logout."'>logout</a></span>";
							
						} else { //otherwise, user is not currently logged in
							$login = "login.html";
							$create = "createAccount.html";
							echo "<span class='head'><a href='".$login."'>Login</a></span>";
							echo "<span class='firstname'></span>";//firstname span adds a margin to separate options
							echo "<span class='head'><a href='".$create."'>Sign Up</a></span>";
						}
?>