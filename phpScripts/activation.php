<?php
session_start();
if(isset($_GET['login']) && isset($_GET['code'])){
    $login=$_GET['login'];
    $activation=$_GET['code'];
    $error;
    $msg;
    include "BaseDate.php";;
    if($result=$db->query("select password,salt from Users where login='$login'")){
        if($result->num_rows>0){
            $row=$result->fetch_assoc();
            $password=$row['password'];
            $salt=$row['salt'];
            $code=md5($login.$salt.$password.'danilOlegovich');
            if($code==$activation){
                $db->query("update Users set activation='1' where login='$login'");
                $_SESSION['login']=$login;
                $_SESSION['activation']=1;
                setcookie('password',$password,time()+50000);
                setcookie('login',$login,time()+50000);
                $msg="Вы успешно активировали аккаунт можете перейти по ссылке <a href=../index.html>Вход</a>";
            }
            else{
                $error="Не правильный хеш активации";
            }
        }
        else{
           $error="Такого пользователя не существует";
        }
    }
}?>
<!DOCTYPE html>
<html>
<head>
    <title>Мозг</title>
    <link type="text/css" rel="stylesheet" href="../style.css">
    <link type="text/css" rel="stylesheet" href="mediaScreenNews.css">
    <script src="../jquery-3.0.0.min.js"></script>
    <title>Освободи свой разум от мыслей здесь</title>
</head>
<body>
<header>
    <div class="header">
        <p>Активация<p>
    </div>
</header>
<article>
    <div class="box">
        <?if (isset($msg)){?>
            <h1><?=$msg?></h1>
        <?}?>
        <?if(isset($error)){?>
            <h1><?=$error?></h1>
        <?}?>
    </div>
</article>
<footer>
    <div class="footer">
        Хочешь чтобы что-то добавили на сайт? Пиши на почту and-d-o@yandex.ru
    </div>
</footer>
</body>
</html>
