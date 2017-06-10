<?php
session_start();
header("Content-Type: text/event-stream\n\n");
header('Cache-Control: no-cache');
include "BaseDate.php";
if($_SESSION['login']){
    $login=$_SESSION['login'];
    $r=array();
        if ($result = $db->query("select IDMessages,sender from Messages where recipient='$login' and newMessage='1'")) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $db->query("update Messages set newMessage='0' WHERE IDMessages='" . $row['IDMessages'] . "'");
                    $r[] = $row;
                }
                echo 'data:' . json_encode($r);
                echo "\n\n";
            } else {
                echo 'data:null';
                echo "\n\n";
            }
        }
}