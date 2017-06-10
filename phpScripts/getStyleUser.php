<?php

if(isset($_SESSION['login'])) {
    include "BaseDate.php";
    $row=array();
    $imageUser=array();
    $login = $_SESSION['login'];
    if ($result = $db->query("select login from StyleUser where login='$login'")) {
        if ($result->num_rows > 0) {
            if ($result = $db->query("select * from StyleUser where login='$login'")) {
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                }
            }
        }
    }
    if($result1=$db->query("select image from Users where login='$login'")){
        $imageUser=$result1->fetch_assoc();
    }
    ?>
    <style type="text/css">
        body {
            background: url('<?=$row['background']?>') <?=$row['backgroundColor']?>;
            background-size: 100% 100%;
        }
        header {
            background-color: <?=$row['headerColor']?>;
        }
        footer {
            background-color: <?=$row['footerColor']?>;
        }
        .buttonAll{
            Color: <?=$row['buttonAllColor']?>;
        }
        .buttonAll>a{
            Color: <?=$row['buttonAllColor']?>;
        }
        .buttonAllActive{
            Color: <?=$row['buttonAllColor']?>;
        }
        .buttonAll>form>input{
            Color: <?=$row['buttonAllColor']?>;
        }
        .loginUser{
            color: <?=$row['colorLoginUser']?>;
        }
        .nameArticleNews, #descriptionComment
        {
            color: <?=$row['colorNameArtic']?>;
        }
        .textArticleNews{
            color: <?=$row['colorTextArtic']?>;
        }
        .content{
            background-color: <?=$row['colorContent']?>;
        }
        #imageUser{
            background: url('../images/profile/<?=$login?>/<?=$imageUser['image']?>')no-repeat;
            background-size: auto 100%;
        }
    </style>
<?}?>