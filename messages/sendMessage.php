<?php
session_start();
if(isset($_SESSION['login'])){
    $sender=$_SESSION['login'];
    $recipient = $_POST['recipient'];
    $textMessage = $_POST['Message'];
    $fileName=$_POST['fileName'];
    echo json_encode($fileName);
    $fileName=serialize($fileName);
    $textMessage = htmlentities($textMessage);
    $dateMessage = date('Y-m-d');
    $timeMessage = date('H:i:s');
    include '../phpScripts/BaseDate.php';
    $stmt = $db->prepare("insert into Messages (sender,recipient,textMessage,dateMessage,timeMessage,readMessage,newMessage,attachedPhotos) VALUES (?,?,?,?,?,'0','1',?)");
    $stmt->bind_param("ssssss",$sender,$recipient,$textMessage,$dateMessage,$timeMessage,$fileName);
    if($stmt->execute()){
        $stmt->close();
        echo "true";
    }
    else{
        echo $db->error;
    }
}