<?php
session_start();
header("Content-Type: text/event-stream\n\n");
header('Cache-Control: no-cache');

if (isset($_SESSION['login'])){
    $sender=$_SESSION['login'];
    $count;
    include '../phpScripts/BaseDate.php';
    if($result=$db->query("select readMessage from Messages where recipient='$sender' and readMessage='0'")){
        if($result->num_rows>0){
            mysqli_close($db);
            echo "data:".json_encode($result->num_rows);
            echo "\n\n";
        }
        else{
            echo "data: null";
            echo "\n\n";
        }
    }
    else{
        $errorDB=$db->error;
        mysqli_close($db);
        echo $errorDB;
    }
}