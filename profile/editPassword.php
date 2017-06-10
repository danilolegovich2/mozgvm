<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Данил
 * Date: 24.05.2017
 * Time: 19:37
 */
if(isset($_SESSION['login'])) {
    if (isset($_POST['newPass'])) {
        $password = $_POST['newPass'];
        $login = $_SESSION['login'];
        include "../phpScripts/BaseDate.php";
        $password = stripcslashes($password);
        $password = htmlentities($password);
        $password = trim($password);
        $salt = mt_rand(100,999);
        $password = md5(md5($password).$salt);
        $password = strrev($password);
        $stmt=$db->prepare("update Users set password=?, salt='$salt'");
        $stmt->bind_param('s',$password);
        if ($stmt->execute()) {
            $stmt->close();
            echo "true";
        } else {
            $stmt->close();
            echo "false";
        }
    }
}
