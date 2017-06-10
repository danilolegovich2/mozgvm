<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Данил
 * Date: 28.05.2017
 * Time: 22:39
 */
if(isset($_SESSION['login'])){
    $login=$_SESSION['login'];
    include "../phpScripts/BaseDate.php";
    $r=array();
    if($result=$db->query("select sender,recipient from Interlocutor WHERE sender='$login'")){
        while ($row=$result->fetch_assoc()){
            $r[]=$row;
        }
        mysqli_close($db);
        echo json_encode($r);
    }
    else{
        echo $db->error;
    }
}
