<?php
session_start();
if(isset($_SESSION['login'])){
    include "../phpScripts/BaseDate.php";
    $login = $_SESSION['login'];
    if($result=$db->query("select id,background from StyleUser WHERE login='$login'")){
        if($result->num_rows>0){
            $id=$result->fetch_row();
            $id=$id[0];
            $background=$id[1];
            if(!strpos($background,'../images/back2.jpg')){
                unlink($background);
            }
            $db->query("delete from StyleUser where id='$id'");
            $db->query("insert into StyleUser (id,login) VALUES ('$id','$login')");
        }
        header("Location: newDesign.php");
    }
    header("Location: newDesign.php");
}
