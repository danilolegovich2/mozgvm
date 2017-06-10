<?php
session_start();
header("Content-Type: text/event-stream\n\n");
header('Cache-Control: no-cache');
if(isset($_SESSION['login']) && isset($_GET['sender'])){
    $sender=$_GET['sender'];
    $recipient=$_SESSION['login'];
    include "../phpScripts/BaseDate.php";
    if($result=$db->query("select sender,textMessage,dateMessage,timeMessage,attachedPhotos from Messages WHERE sender='$sender' and recipient='$recipient' and readMessage='0' order by IDMessages")){
        if($result->num_rows>0) {
            while ($row = $result->fetch_assoc()) {
                $row['attachedPhotos']=unserialize($row['attachedPhotos']);
                $r[] = $row;
            }
            $db->query("update Messages set readMessage='1' WHERE sender='$sender' and recipient='$recipient'");
            echo "retry: 1000\n";
            echo "data:".json_encode($r);
            echo "\n\n";
        }
        else{
            echo "data: null";
        }
    }
}