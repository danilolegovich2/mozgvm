<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Данил
 * Date: 25.05.2017
 * Time: 20:03
 */
if(isset($_SESSION['login'])){
    include "../phpScripts/BaseDate.php";
    $login=$_SESSION['login'];
    if(isset($_POST['headerColor'])) {
        $headerColor = $_POST['headerColor'];
        $db->query("update StyleUser set headerColor='$headerColor' WHERE login='$login'");
    }
    if(isset($_POST['footerColor'])) {
        $footerColor = $_POST['footerColor'];
        $db->query("update StyleUser set footerColor='$footerColor' WHERE login='$login'");
    }
    if(isset($_POST['backgroundColor'])) {
        $backgroundColor = $_POST['backgroundColor'];
        $db->query("update StyleUser set backgroundColor='$backgroundColor' WHERE login='$login'");
    }
    if(isset($_POST['buttonAllColor'])){
        $buttonAllColor = $_POST['buttonAllColor'];
        $db->query("update StyleUser set buttonAllColor='$buttonAllColor' WHERE login='$login'");
    }
    if(isset($_POST['colorTextArtic'])){
        $colorTextArtic=$_POST['colorTextArtic'];
        $db->query("update StyleUser set colorTextArtic='$colorTextArtic' WHERE login='$login'");
    }
    if(isset($_POST['colorLoginUser'])){
        $colorLoginUser=$_POST['colorLoginUser'];
        $db->query("update StyleUser set colorLoginUser='$colorLoginUser' WHERE login='$login'");
    }
    if(isset($_POST['colorNameArtic'])){
        $colorNameArtic=$_POST['colorNameArtic'];
        $db->query("update StyleUser set colorNameArtic='$colorNameArtic' WHERE login='$login'");
    }
    if(isset($_POST['colorContent'])){
        $colorContent=$_POST['colorContent'];
        $db->query("update StyleUser set colorContent='$colorContent' WHERE login='$login'");
    }
    $db->close();
}
