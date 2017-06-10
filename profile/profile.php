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
		<link type="text/css" rel="stylesheet" href="styleProfile.css">
		<script src="script.js" ></script>
        <script src="../jquery-3.0.0.min.js"></script>
        <script src="../uploadImage.js"></script>
		<? include 'getDescription.php'; ?>
        <? include '../phpScripts/getStyleUser.php' ?>
	</head>
	<body>
		<header>
			<div class="header">
				<p>Делай, что хочешь - это твой профиль</p>
			</div>
            <a href="../news/news.php" class="back buttonAll">Назад</a>
		</header>
		<article>
			<div class="box sidebar">
				<ul class="menu">
					<li class="buttonAll">
						<a onclick="TransiotionToPersonal();">Личные настройки</a>
					</li>
					<li class="buttonAll">
						<a onclick="TransiotionToSecurity();">Настройки безопастности</a>
					</li>
				</ul>
			</div>
			<div class="box">	
				<div class="content personal">
                    <div id="imageUser">

                    </div>
                    <label class="loadPhoto buttonAll" id="loadImage">
                        <span class="button">Загрузить аватар</span>
                        <input type="file" name="file" id="photo" accept="image/*" onchange="uploadPhoto(this)">
                    </label>
                    <input type="text" id="name" name="name" onkeyup="CheckingNickName(this)" value="<?=$_SESSION['login'];?>"><input type="button" class="buttonAll" onclick="uploadLogin()" value="Применить">
                    <p id="checkingNickName"></p>
                    <textarea id="description" onkeyup="uploadDescription()" name="description"><?=$description?></textarea>
                    <p id="uploadDescriptionCheck"></p>
				</div>
				<div class="content security">
					<form class="editPassword">
						<div class="field"><label for="password">Текущий пароль</label><input type="password" required name="password" onkeyup="checkingOldPass(this.form)"></div>
						<div class="field"><label for="newPassword">Новый пароль</label><input type="password" required name="newPassword" onkeyup="CheckingPassword(this.form); CheckingRepeatPassword(this.form);"></div><p id="checkingPassword" style="font-family: Bodoni;"></p>
						<div class="field"><label for="repeatPassword">Повторите пароль</label><input type="password" required name="repeatPassword" onkeyup="CheckingRepeatPassword(this.form)"></div>
                        <p id="acceptPass"></p>
						<input type="button" class="buttonAll" value="Изменить пароль" onclick="Accept(this.form)">
					</form>
				</div>
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