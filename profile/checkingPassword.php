<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Данил
 * Date: 24.05.2017
 * Time: 21:15
 */
if(isset($_SESSION['login'])) {
    if (isset($_POST['oldPass'])) {
        $password = $_POST['oldPass'];
        $password = htmlentities(stripslashes($password));
        $login = $_SESSION['login'];
        include "../phpScripts/BaseDate.php";
        $password = stripslashes($password);
        $password = htmlentities($password);
        if ($result = $db->query("select salt from Users where login='$login'")) {
            $row = $result->fetch_row();
            $salt = $row[0];
            $password = md5(md5($password) . $salt);
            $password = strrev($password);
            if($result = $db->query("select password from Users where login='$login'")){
                $row=$result->fetch_row();
                $pass=$row[0];
                if($pass==$password){
                    mysqli_close($db);
                    echo "true";
                }
                else{
                    mysqli_close($db);
                    echo "false";
                }
            }
        }
    }
}