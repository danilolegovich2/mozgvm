<?php
	$nickName = $_POST['nickName'];
	$nickName = htmlentities($nickName);
	include "BaseDate.php";
	$result=$db->query("select login from Users where login='".$nickName."'");
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
	
