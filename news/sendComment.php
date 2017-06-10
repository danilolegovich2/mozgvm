<?php
session_start();
if(isset($_SESSION['login'])){
    include "../phpScripts/BaseDate.php";
    $login=$_SESSION['login'];
    $loginUser=$_POST['loginUser'];
    $nameArticle=$_POST['nameArticle'];
    $timePublish=$_POST['timePublish'];
    $datePublish=$_POST['datePublish'];
    $textComment=htmlentities($_POST['textComment']);
    if($result=$db->query("select * from Article where login='$loginUser' and nameArticle='$nameArticle' and timePublish='$timePublish' and datePublish='$datePublish'")){
        if($result->num_rows>0){
            $row=$result->fetch_assoc();
        }
        else{
            echo 'Такой статьи нет';
        }
    }
    else{
        echo $db->error;
    }
    $time = date('H:i:s');
    $date = date('Y-m-d');
    $id=$row['id'];
    $stmt=$db->prepare("insert into Comment (IdArticle,LoginUser,TextComment,TimeComment,DateComment) VALUES (?,?,?,?,?)");
    $stmt->bind_param('sssss',$id,$login,$textComment,$time,$date);
    if($stmt->execute()){
        echo 'true';
    }
    else
    {
        $db->error;
    }
}
else {
    echo 'false';
}