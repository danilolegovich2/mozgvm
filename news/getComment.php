<?php
include "../phpScripts/BaseDate.php";
$loginUser=$_POST['loginUser'];
$nameArticle = $_POST['nameArticle'];
$count = $_POST['count'];
$timePublish=$_POST['timePublish'];
$datePublish=$_POST['datePublish'];
$r=array();
if($result=$db->query("select Comment.id,Comment.LoginUser,Comment.TextComment,Comment.TimeComment,Comment.DateComment from Comment inner join Article on Article.id=Comment.IdArticle where Article.nameArticle='$nameArticle' and Article.login='$loginUser' and Article.timePublish='$timePublish' and Article.datePublish='$datePublish' and Comment.id>'$count'")){
    if($result->num_rows>0) {
        while ($row = $result->fetch_assoc()) {
            $row['TextComment'] = htmlspecialchars_decode($row['TextComment']);
            $r[] = $row;
        }
        echo json_encode($r);
    }
    else{
        echo 'null';
    }
}