<?php 
	$hostname_db = "140.115.197.68";
	$database_db = "pass";
	$username_db = "ccReader";
	$password_db = "XZ5yu4QhMM1";
	$conn = mysqli_connect($hostname_db, $username_db, $password_db, $database_db);
	if ($conn->connect_error) 
	{
		echo "Error!";
		die("Connection failed: " . $conn->connect_error);
	} 
	else
	{
		echo "Success!";
		$conn->set_charset("utf8");
	}
	
?>