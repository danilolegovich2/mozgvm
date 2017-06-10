<?php
if($_FILES['file']['size']>0){

    $file=$_FILES['file'];
    $nameFile=$_POST['fileName'];

    $uploadDir = 'images/'.$nameFile;
    if(move_uploaded_file($file['tmp_name'],$uploadDir)){
        echo 'true';
    }
    else{
        echo 'false';
    }
}
else{
    echo "нет файла";
}