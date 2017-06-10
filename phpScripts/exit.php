<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Данил
 * Date: 24.05.2017
 * Time: 0:16
 */
if(isset($_POST['exit'])){
    $_SESSION=array();
    session_unset();
    session_destroy();
    setcookie('login','',time()-350000);
    setcookie('password','',time()-350000);
    header("Location: ../index.html");
}