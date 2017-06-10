<?php
/**
 * Created by PhpStorm.
 * User: Данил
 * Date: 26.05.2017
 * Time: 15:56
 */
$count;
include "../phpScripts/BaseDate.php";
if($_POST['count']>0){
    $count=$_POST['count'];
    $hem;
    $currentDate = date('Y-m-d');
    if(isset($_POST['hem'])){
        $hem=$_POST['hem'];
        if($result=$db->query("select * from Article where hem='$hem' and id>'count' order by id desc LIMIT $count,10")) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $row['nameArticle']=htmlspecialchars_decode($row['nameArticle']);
                    $row['textArticle']=htmlspecialchars_decode($row['textArticle']);
                    $r[] = $row;
                }
                mysqli_close($db);
                echo json_encode($r);
            } else {
                mysqli_close($db);
                echo "false";
            }
        }
        else{
            echo "Ошибка при 1 запросе";
        }
    }
    else {
        if($result = $db->query("select * from Article where id>'count' order by id desc LIMIT $count,10")) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $row['nameArticle']=htmlspecialchars_decode($row['nameArticle']);
                    $row['textArticle']=htmlspecialchars_decode($row['textArticle']);
                    $r[] = $row;
                }
                mysqli_close($db);
                echo json_encode($r);
            } else {
                mysqli_close($db);
                echo "false";
            }
        }
        else{
            echo "Ошибка при 2 запросе";
        }
    }
}
else {
    if(isset($_POST['hem'])){
        $hem=$_POST['hem'];
        if($result=$db->query("select * from Article where hem='$hem' order by id desc LIMIT 10")) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $row['nameArticle']=htmlspecialchars_decode($row['nameArticle']);
                    $row['textArticle']=htmlspecialchars_decode($row['textArticle']);
                    $r[] = $row;
                }
                mysqli_close($db);
                echo json_encode($r);
            } else {
                mysqli_close($db);
                echo "false";
            }
        }
        else{
            echo "Ошибка при 3 запросе";
        }
    }
    else {
        if($result = $db->query("select * from Article order by id desc limit 10")) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $row['nameArticle']=htmlspecialchars_decode($row['nameArticle']);
                    $row['textArticle']=htmlspecialchars_decode($row['textArticle']);
                    $r[] = $row;
                }
                mysqli_close($db);
                echo json_encode($r);
            } else {
                mysqli_close($db);
                echo "false";
            }
        }
        else{
            echo "ошибка при 4 запросе".$db->error;
        }
    }
}
