<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Данил
 * Date: 29.05.2017
 * Time: 0:22
 */
if(isset($_SESSION{'login'})){
    $sender=$_SESSION['login'];
    $recipient = $_POST['Recipient'];
    include "../phpScripts/BaseDate.php";
    if($result=$db->query("select sender,textMessage,dateMessage,timeMessage,attachedPhotos from Messages WHERE (sender='$sender' and recipient='$recipient') or (sender='$recipient' and recipient='$sender') order by IDMessages")){
        if($result->num_rows>0) {
            while ($row = $result->fetch_assoc()) {
                $row['attachedPhotos']=unserialize($row['attachedPhotos']);
                $r[] = $row;
            }
            $db->query("update Messages set readMessage='1' WHERE sender='$recipient' and recipient='$sender' and readMessage='0'");
            mysqli_close($db);
            echo json_encode($r);
        }
        else{
            echo "false";
        }
    }
    else{
        $errorDB=$db->error;
        mysqli_close($db);
        echo $errorDB;
    }
}
else{
    echo "false";
}