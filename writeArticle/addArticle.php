<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Данил
 * Date: 26.05.2017
 * Time: 15:18
 */
if(isset($_SESSION['login'])){
    $nameArticle=$_POST['nameArticle'];
    $textArticle=$_POST['textArticle'];
    $nameArticle=htmlentities($nameArticle);
    $textArticle=htmlentities($textArticle);
    $hem=$_POST['hem'];
    $date = date('Y-m-d');
    $time = date("H:i:s");
    $login = $_SESSION['login'];
    include "../phpScripts/BaseDate.php";
    $stmt=$db->prepare("insert into Article (login,nameArticle,textArticle,hem,datePublish,timePublish) VALUES (?,?,?,?,?,?)");
    $stmt->bind_param("ssssss",$login,$nameArticle,$textArticle,$hem,$date,$time);
    if($stmt->execute()){
        $stmt->close();
        echo "true";
    }
    else{
        echo "false ".$db->error;
    }
}
else{
    echo "false";
}