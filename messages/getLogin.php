<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Данил
 * Date: 28.05.2017
 * Time: 18:57
 */

if(isset($_SESSION['login'])){
    $loginUsers=array();
    $interlocutors=array();
    $res=array();
    include "../phpScripts/BaseDate.php";
    $login = $_SESSION['login'];
    if($result = $db->query("Select login from Users WHERE login<>'$login' order by login"))/* inner join Interlocutor on Users.login=Interlocutor.sender */{
        while($row=$result->fetch_assoc()){
                $loginUsers[] = $row;
        }
    }
    else{
        echo $db->error;
    }
    if($result=$db->query("Select sender from Interlocutor where recipient='$login'")){
        while($row=$result->fetch_assoc()){
            $interlocutors[]=$row;
        }
    }
    else{
        echo $db->error;
    }
    $flag;
    $temp;
    foreach ($loginUsers as $loginUser){
        foreach ($interlocutors as $interlocutor){
            if($loginUser['login']==$interlocutor['sender']){
                $flag=false;
                break;
            }
            else{
                $flag=true;
                $temp=$loginUser['login'];
            }
        }
        if($flag) {
            $res[] = array('login' => $temp);
        }
    }
    echo json_encode($res);
}
