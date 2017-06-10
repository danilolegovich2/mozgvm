<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Данил
 * Date: 23.05.2017
 * Time: 18:38
 */
include "../phpScripts/BaseDate.php";
if(isset($_SESSION['login'])) {
    if (isset($_POST['description'])) {
        $login = $_SESSION['login'];
        $description = $_POST['description'];
        $description = htmlentities($description);
        $stmt = $db->prepare("update Users set description=? where login='$login'");
        $stmt->bind_param("s", $description);
        if($stmt->execute()){
            echo 'true';
            $stmt->close();
        }
        else{
            echo $db->error;
        }
    }
    if (isset($_POST['newLogin'])) {
        $login = $_SESSION['login'];
        $newLogin = $_POST['newLogin'];
        $stmt = $db->prepare("update Users set login=? WHERE login='$login'");
        $stmt->bind_param('s',$newLogin);
        if($stmt->execute()){
            echo 'true';
            rename('../images/profile/'.$login.'/','../images/profile/'.$newLogin.'/');
            $_SESSION['login']=$newLogin;
            setcookie('login',$newLogin,time()+50000);
            $stmt->close();
        }
        else{
            echo $db->error;
        }
    }
}