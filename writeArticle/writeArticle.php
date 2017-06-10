<?php session_start();
if (!isset($_SESSION['login']) || $_SESSION['activation']!=1){
    header("Location: ../index.html");
}
?>
<!DOCTYPE html>
<html>
	<head>
        <title>Мозг</title>
		<link type="text/css" rel="stylesheet" href="../style.css">
        <link type="text/css" rel="stylesheet" href="mediaScreenWriteArticle.css">
        <script src="script.js" type="text/javascript"></script>
        <script src="../jquery-3.0.0.min.js"></script>
        <script src="../buzz.min.js"></script>
	</head>
	<body>
        <?include "../phpScripts/getStyleUser.php";?>
		<header>
			<div class="header">
				<p>Начинай писать, если пришел</p>
			</div>
			<a href="../news/news.php" class="back buttonAll">Назад</a>
		</header>
		<article>
			<div class="content">
				<form action="addArticle.php" method="post" id="writeAr">
                    <input type="text" placeholder="Заголовок" name="nameArticle" class="nameArticle"><br>
					<textarea placeholder="Пиши скорей" name="textArticle" class="article"></textarea>
					<div class="selectWrapper">
						<div class="select-arrow-1"></div>
						<select name="hem">
							<option selected value="leftM">Наука</option>
							<option value="rightM"><div>Искусство</div></option>
						</select>
					</div>
					<input type="button" value="Опубликовать" id="load" class="buttonAll" onclick="submitArticle(this.form)">
					
				</form>	
			</div>
            <?include "../phpScripts/NewMessageNotification.php";?>
		</article>
	</body>
</html>