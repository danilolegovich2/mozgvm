<?php
session_start();
if(isset($_SESSION['login'])){
    $nameFile = $_POST['fileName'];
    $recipient = $_POST['recipient'];
    $sender = $_SESSION['login'];
}
