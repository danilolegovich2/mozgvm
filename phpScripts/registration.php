<?php
	session_start();
	$login = $_POST['Login'];
	$email = $_POST['Email'];
	$password = $_POST['Password'];
	$email=htmlentities($email);
	$login = stripcslashes($login);
	$login = htmlentities($login);
	$password = stripcslashes($password);
	$password = htmlentities($password);
	$login = trim($login);
	$password = trim($password);
	$salt = mt_rand(100,999);
	$password = md5(md5($password).$salt);
	$password = strrev($password);
	$time=date('H:i:s');
	$date=date('Y-m-d');
	include "BaseDate.php";
	$stmt=$db->prepare("insert into Users(email, password, login, salt,dateReg,timeReg) VALUES (?,?,?,?,?,?)");
	$stmt->bind_param('ssssss',$email,$password,$login,$salt,$date,$time);
	if($stmt->execute()){
	    $stmt->close();
		$_SESSION['login']=$login;
		$_SESSION['activation']=0;
		if(!$db->query("insert into StyleUser (login) VALUES ('$login')"))
        {
            echo $db->error;
        }
		setcookie("login",$login,time()+50000);
		setcookie("password",$password,time()+50000);
		if($result=$db->query("select salt from Users where login='$login'")){
		    if($result->num_rows>0) {
                $row = $result->fetch_assoc();
                $salt = $row['salt'];
                $code = md5( $login . $salt . $password . 'danilOlegovich');
                $link = 'https://www.mozgvm.ru/phpScripts/activation.php?login=' . $login . '&code=' . $code;
                $msg = "Для активации аккаунта на сайте mozgvm.ru перейдите по ссылке <a href='" . $link . "'>активация</a>";
                $subject = "Активация аккаунта на mozgvm.ru";
                $headers = "Content-type: text/html; charset=utf-8\r\n";
                $headers.="From: <admin@mozgvm.ru>\r\n";
                if(!mail($email, $subject, $msg, $headers))
                {
                    echo 'false';
                }
                echo "true";
            }
            else{
		        echo 'нет записи в бд';
            }
        }
        else{
		    $db->error;
        }
	}
	else{
	    echo $db->error;
    }
