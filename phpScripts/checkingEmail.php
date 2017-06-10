<?php
	include 'BaseDate.php';
	$email = $_POST['Email'];
	$email=htmlentities($email);
	$result = $db->query("select email from Users where email='".$email."'");
	if($result->num_rows>0)
	{
		mysqli_close($db);
		echo "false";
	}
	else
	{
		mysqli_close($db);
		echo "true";
	}
	
