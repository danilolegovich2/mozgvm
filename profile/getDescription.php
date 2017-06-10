<?php
    include "../phpScripts/BaseDate.php";
    if(isset($_SESSION['login'])) {
        $login = $_SESSION['login'];
        $description;
        if ($result = $db->query("select description from Users where login='$login'")) {
            $description = $result->fetch_row();
            if (isset($description[0])) {
                $description = htmlspecialchars_decode($description[0]);
            } else {
                $description = "Описание";
            }
        }
        $image;
        if ($result = $db->query("select image from Users where login='$login'")) {
            $image = $result->fetch_row();
            if (isset($image[0])) {
                $image = $image[0];
            } else {
                $image = "";
            }
        }
    }
    else{
        header("Location: ../index.html");
    }
