<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Данил
 * Date: 28.05.2017
 * Time: 21:50
 */
if(isset($_SESSION['login'])){
    $login=$_SESSION['login'];
    $recipient=$_POST['Login'];
    include "../phpScripts/BaseDate.php";
    if($db->query("insert into Interlocutor (sender,recipient) VALUES ('$login','$recipient')") && $db->query("insert into Interlocutor (sender,recipient) VALUES ('$recipient','$login')")){
        mysqli_close($db);
        echo "true";
    }
    else
    {
        echo $db->error;
    }
}
else{
    header("Location: ../index.html");
}