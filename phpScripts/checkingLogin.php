<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Данил
 * Date: 29.05.2017
 * Time: 15:39
 */
include "BaseDate.php";
if(isset($_SESSION['login'])){
    $login=$_SESSION['login'];
    if(!isset($_COOKIE['login']) && !isset($_COOKIE['password'])){
        setcookie("login",$login,time()+50000);
        if($result=$db->query("select password,activation from Users where login='$login'")){
            if($result->num_rows>0){
                $row=$result->fetch_assoc();
                setcookie("password",$row['password'],time()+50000);
                $_SESSION['activation']=$row['activation'];
                echo "true";
            }
            else{
                echo "false";
            }
        }
        else{
            $errorDB=$db->error;
            mysqli_close($db);
            echo $errorDB;
        }
    }
    else{
        $login=$_COOKIE['login'];
        $password=$_COOKIE['password'];
        if($result = $db->query("select login,password,activation from Users where login='$login' and password='$password'")){
            if($result->num_rows>0){
                $row=$result->fetch_assoc();
                setcookie("login",$login,time()+50000);
                setcookie("password",$password,time()+50000);
                $_SESSION['login']=$login;
                $_SESSION['activation']=$row['activation'];
                mysqli_close($db);
                echo "true";
            }
            else{
                mysqli_close($db);
                echo "false";
            }
        }
        else{
            $errorDB=$db->error;
            mysqli_close($db);
            echo $errorDB;
        }
    }
}
else if(isset($_COOKIE['login']) && isset($_COOKIE['password'])){
    $login=$_COOKIE['login'];
    $password=$_COOKIE['password'];
    if($result = $db->query("select login,password,activation from Users where login='$login' and password='$password'")){
        if($result->num_rows>0){
            $row=$result->fetch_assoc();
            setcookie("login",$login,time()+50000);
            setcookie("password",$password,time()+50000);
            $_SESSION['login']=$login;
            $_SESSION['activation']=$row['activation'];
            mysqli_close($db);
            echo "true";
        }
        else{
            mysqli_close($db);
            echo "false";
        }
    }
    else{
        $errorDB=$db->error;
        mysqli_close($db);
        echo $errorDB;
    }
}
else{
    mysqli_close($db);
    echo "false";
}