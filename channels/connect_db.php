<?php
/*
	connect_db.php
	Robert Yaffe
*/
			//connect to mysql server
			$db = mysql_connect("studentdb-maria.gl.umbc.edu","ryaffe1","ryaffe1");
			if(!$db)
				exit("Error - could not connect to MySQL");

			//select the db
			$er = mysql_select_db("ryaffe1");
			if(!$er)
				exit("Error - could not select the database");
?>