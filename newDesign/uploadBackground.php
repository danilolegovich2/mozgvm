<?php session_start();

$file=$_FILES['file'];
$uploadDir = '../images/background/';

$filename = time() . '-' . mt_rand(0000, 9999) . basename($file);

move_uploaded_file($file['tmp_name'], $uploadDir.$filename);
include "../phpScripts/BaseDate.php";
$login=$_SESSION['login'];
if($result=$db->query("select background from StyleUser WHERE login='$login'")){
    $background = $result->fetch_assoc();
    $background=$background['background'];
    if(!strpos($background,'back2.jpg')){
        unlink($background);
    }
    if(!($db->query("update StyleUser set background='".$uploadDir.$filename."' WHERE login='$login'"))){
        echo $db->error;
    }
    echo $uploadDir.$filename;
}
else{
    echo $db->error;
}
