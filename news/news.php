<?php session_start()?>
<!DOCTYPE html>
<html>
	<head>
        <title>Мозг</title>
		<link type="text/css" rel="stylesheet" href="../style.css">
        <link type="text/css" rel="stylesheet" href="styleNews.css">
		<link type="text/css" rel="stylesheet" href="mediaScreenNews.css">
        <script src="getComment.js"></script>
        <script src="script.js"></script>
        <script src="../jquery-3.0.0.min.js"></script>
		<title>Освободи свой разум от мыслей здесь</title>
	</head>
	<body onload="GetArticle('',document.querySelector('#firstButton'));NotifMessage();">
        <? include "../phpScripts/getStyleUser.php";?>
		<header>
			<div class="header">
				<p>Оставь свои мысли здесь!<p>
				<ul class="login">
                <?php if(!isset($_SESSION['login'])){?>
					<li class="buttonAll">
						<a href="../index.html">Вход</a>
					</li>
					<li class="buttonAll">
						<a href="../index.html">Регистрация</a>
					</li>
                <?} else{?>
                    <li class="buttonAll">
                        <form action="../phpScripts/exit.php" method="POST">
                            <input type="submit" name="exit"  id="exit" value="Выход">
                        </form>
                    </li>
                <?}?>
				</ul>
			</div>
		</header>
		<article>
			<div class="box sidebar">
				<ul class="menu"> 
					<li class="buttonAll" id="firstButton" onclick="GetArticle('',this);">
						Передний мозг
					</li>
					<li class="buttonAll"  onclick="GetArticle('rightM',this);">
						Правое полушарие
					</li>
					<li class="buttonAll" onclick="GetArticle('leftM',this);">
						Левое полушарие
					</li>
                    <?php if(isset($_SESSION['login']) && $_SESSION['activation']==1){?>
                        <li class="buttonAll">
                            <a href="../writeArticle/writeArticle.php">Высвободить мысли</a>
                        </li>
                        <li class="buttonAll">
                            <a href="../messages/messages.php" id="linkMessage">Сообщения</a>
                        </li>
                        <li class="buttonAll">
                            <a href="../profile/profile.php">Настройки</a>
                        </li>
                        <li class="buttonAll">
                            <a href="../newDesign/newDesign.php">Не нравится дизайн?</a>
                        </li>
                    <?}?>
				</ul>
			</div>
			<div class="box news">
                <div id="parent">
                    <div id="wrapper">
                        <div class="content">

                        </div>
                    </div>
                    <script>
                        $('.content').ready(function () {
                            updateCountComArticle(this);
                        })
                        $("#wrapper").scroll(function () {
                            if(this.scrollTop == this.scrollHeight-this.clientHeight){
                                UpdateArticle();
                            }
                        });
                    </script>
                </div>
			</div>
            <div class="box divComment">
                <p id="descriptionComment"></p>
                <div id="wrapperCom">

                </div>
                <?if(isset($_SESSION['login'])&&$_SESSION['activation']==1){?>
                    <div id="writeCom">
                        <textarea id="write" onkeyup="CheckEnterCom(event)"></textarea>
                        <input type="button" class="buttonAll" value="Отправить" onclick="sendComment()">
                    </div>
                <?}?>
            </div>
            <?include "../phpScripts/NewMessageNotification.php";?>
		</article>
		<footer>
			<div class="footer">
				Хочешь чтобы что-то добавили на сайт? Пиши на почту and-d-o@yandex.ru
			</div>			
		</footer>
	</body>
</html>