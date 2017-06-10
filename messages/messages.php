<?php session_start();
if (!isset($_SESSION['login']) || $_SESSION['activation']!=1){
    header("Location: ../index.html");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Мозг</title>
        <link type="text/css" rel="stylesheet" href="../style.css">
        <link type="text/css" rel="stylesheet" href="styleMessage.css">
        <script src="script.js"></script>
        <script src="../jquery-3.0.0.min.js"></script>
        <script src="../uploadImage.js"></script>
    </head>
    <body onload="getInterlocutor(); UpdateNotifMessage();" id="body">
        <?include "../phpScripts/getStyleUser.php";?>
        <header>
            <div class="header">
                <p>Общайся сколько угодно</p>
            </div>
            <a href="../news/news.php" class="back buttonAll">Назад</a>
        </header>
        <article>
            <div class="box sidebar">
                <ul class="sender">

                </ul>
                <div class="buttonAll" id="buttonAdd" onclick="FindInterlocutor()">+Добавить собеседника</div>
                <div id="parentAddInter">
                    <div contenteditable="true" onclick="this.innerHTML=''">
                        Начните вводить логин
                    </div>
                    <div class="addInterlocutor">

                    </div>
                </div>
            </div>

            <div class="box content">
                <div class="buttonAll" id="btnSend" onclick="sendMessage()">Отправить</div>
                <label class="loadImage buttonAll" id="loadImage" style="float: left;">
                    <span class="button" style="background: url('../images/attached.png'); background-size: 100% 100%;"></span>
                    <input type="file" name="file" id="photo" accept="image/*" multiple="true" onchange="uploadImage(this)">
                </label>
                <div id="parent">
                    <div id="wrapper">

                    </div>
                </div>
                <div class="sendMess">
                    <div id="attachedPhotos">

                    </div>
                    <div>
                        <textarea id="message" onkeyup="CheckEnter(event)"></textarea>
                    </div>
                </div>
            </div>
        </article>
        <footer>
            <div class="footer">
                Хочешь чтобы что-то добавили на сайт? Пиши на почту and-d-o@yandex.ru
            </div>
        </footer>
    </body>
</html>