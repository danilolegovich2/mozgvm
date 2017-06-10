<?php
	session_start();
	include "BaseDate.php";
	$login=$_POST['Login'];
    $login = stripcslashes($login);
	$login = htmlentities($login);
	$password=$_POST['Password'];
	$password=stripslashes($password);
	$password=htmlentities($password);
	$stmt=$db->prepare("select salt from Users where login=?");
	$stmt->bind_param('s',$login);
	$stmt->bind_result($salt);
	if($stmt->execute()){
	    $result=$stmt->get_result();
	    $row=$result->fetch_row();
		$salt=$row[0];
		$password=md5(md5($password).$salt);
		$password=strrev($password);
		$stmt=$db->prepare("select login, password, activation from Users where login=? and password=?");
		$stmt->bind_param('ss',$login,$password);
		if($stmt->execute()){
		    $result=$stmt->get_result();
			if($result->num_rows>0){
				$row=$result->fetch_assoc();
				$activation = $row['activation'];
				$_SESSION['activation']=$activation;
				$_SESSION['login']=$login;
				setcookie("login",$login,time()+50000);
				setcookie("password",$password,time()+50000);
				echo "true";
			}
			else{
				mysqli_close($db);
				echo "не нашел совпадений";
			}
		}
		else{
			echo "false ".$db->error;
		}
	}
	else{
		echo "false ".$db->error;
	}	
