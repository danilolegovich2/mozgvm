<?php
session_start();
header("Content-Type: text/event-stream\n\n");
header('Cache-Control: no-cache');

$close=true;
if(isset($_SESSION['login'])){
    $sender = $_SESSION['login'];
    include '../phpScripts/BaseDate.php';
    $countMessage = array();
    $recipient = array();
    if ($result = $db->query("select DISTINCT recipient from Interlocutor where sender='$sender' order by recipient")) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $recipient[] = $row['recipient'];
            }
        }
    }
    foreach ($recipient as $rec) {
        if ($result = $db->query("select readMessage from Messages where recipient='$sender' and sender='$rec' and readMessage='0'")) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_row();
                $countMessage[] = array('sender' => $rec, 'count' => $result->num_rows);
                echo 'data:' . json_encode($countMessage);
                echo "\n\n";
            } else {
                echo 'data: null';
                echo "\n\n";
            }
        }
    }
}
