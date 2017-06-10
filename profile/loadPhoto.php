<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Данил
 * Date: 23.05.2017
 * Time: 18:38
 */
include "../phpScripts/BaseDate.php";
if(isset($_SESSION['login'])) {
    if (isset($_POST['description'])) {
        $login = $_SESSION['login'];
        $description = $_POST['description'];
        $description = htmlentities($description);
        $stmt=$db->prepare("update Users set description=? where login='$login'");
        $stmt->bind_param("s",$description);
        $stmt->execute();
        $stmt->close();
    }
    if ($_FILES['photo']['size'] > 0) {
        $name = basename($_FILES['photo']['name']);
        $login = $_SESSION['login'];

        $images = '../images/profile/' . $login . '/';
        if (!file_exists($images)) {
            mkdir($images, 0755);
            $images = $images . $name;
        } else {
            $images = $images . $name;
        }
        move_uploaded_file($_FILES['photo']['tmp_name'], "$images");
        if ($db->query("update Users set image='$name' where login='$login'")) {
            header("Location: profile.php");
        }
    } else {
        header("Location: profile.php");
    }
}