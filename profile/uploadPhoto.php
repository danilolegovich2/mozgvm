<?php session_start();

$login=$_SESSION['login'];
$file = $_FILES['file'];
$uploadDir = '../images/profile/'.$login.'/';

$filename = time() . '-' . mt_rand(0000, 9999) . basename($file);

move_uploaded_file($file['tmp_name'], $uploadDir.$filename);
include "../phpScripts/BaseDate.php";
if($result=$db->query("select image from Users WHERE login='$login'")){
    $background = $result->fetch_row();
    $background=$uploadDir.$background[0];
    unlink($background);
    $db->query("update Users set image='".$filename."' WHERE login='$login'");
}
