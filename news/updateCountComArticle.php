<?php
header("Content-Type: text/event-stream\n\n");
include "../phpScripts/BaseDate.php";
$resultCom = array();
$r=array();
if($result=$db->query("select DISTINCT IdArticle from Comment")){
    while ($row=$result->fetch_assoc()){
        $r[]=$row;
    }
    foreach ($r as $item){
        $id=$item['IdArticle'];
        if($result=$db->query("select IdArticle from Comment where IdArticle='$id'")) {
            if ($result->num_rows > 0) {
                $resultCom[] = array('IdArticle' => $id, 'countCom' => $result->num_rows);
            }
        }
    }
    if(isset($resultCom)) {
        echo "retry: 1000\n";
        echo "data:" . json_encode($resultCom);
        echo "\n\n";
    }
    else{
        echo "data:null\n\n";
    }
}
else{
    $db->error;
}