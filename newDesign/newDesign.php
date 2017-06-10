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
    <link type="text/css" rel="stylesheet" href="styleDesign.css">
    <script src="script.js" ></script>
    <script src="../jquery-3.0.0.min.js"></script>
    <script src="../uploadImage.js"></script>
    <? include '../phpScripts/getStyleUser.php' ?>
</head>
<body>
<header>
    <div class="header">
        <p>Из тебя выйдет отличный дизайнер</p>
    </div>
    <a href="../news/news.php" class="back buttonAll">Назад</a>
</header>
<article>
    <div class="content style">
            <div id="parent">
                <div id="load"></div>
                <div id="wrapper">
                    <div class="row">
                        <div class="left">
                            <div class="color">
                                <p>Выберите цвет шапки</p>
                                <a class="color" onclick="SetColorAndAccept('#FF7400','headerColor','header','background')"></a><a class="color" onclick="SetColorAndAccept('#A60000','headerColor','header','background')"></a><a class="color" onclick="SetColorAndAccept('#008500','headerColor','header','background')"></a><a class="color" onclick="SetColorAndAccept('#fedd6f','headerColor','header','background')"></a>
                                <div class="setColor">
                                    <p>Если не нравятся цвета выше</p>
                                    <div>
                                        <input type="color" id="SetColorH" oninput="SetColorChangeOpacityAndAccept('headerColor',this,'opacityHead','header','background');">
                                    </div>
                                </div>
                                <div>
                                    <p>Прозрачность фона: <input id="rangeHead" type="range" min="0" max="1" step="0.1" value="1" oninput="SendOpacity('headerColor',this,'#rangeH','header')"><a id="rangeH" style="font-family: Bodoni;">1</a></p>
                                </div>
                            </div>
                            <div class="color">
                                <p>Выберите цвет подвала</p>
                                <a class="color" onclick="SetColorAndAccept('#FF7400','footerColor','footer','background')"></a><a class="color" onclick="SetColorAndAccept('#A60000','footerColor','footer','background')"></a><a class="color" onclick="SetColorAndAccept('#008500','footerColor','footer','background')"></a><a class="color" onclick="SetColorAndAccept('#fedd6f','footerColor','footer','background')"></a>
                                <div class="setColor">
                                    <p>Если не нравятся цвета выше</p>
                                    <div>
                                        <input type="color" id="SetColorF" oninput="SetColorChangeOpacityAndAccept('footerColor',this,'opacityFoot','footer','background');">
                                    </div>
                                </div>
                                <div>
                                    <p>Прозрачность фона: <input id="rangeFoot" type="range" min="0" max="1" step="0.1" value="1" oninput="SendOpacity('footerColor',this,'#rangeF','footer')"><a id="rangeF" style="font-family: Bodoni;">1</a></p>
                                </div>
                            </div>
                            <div class="color">
                                <p>Выберите цвет блоков с контентом</p>
                                <a class="color" onclick="SetColorAndAccept('#FF7400','colorContent','.content','background')"></a><a class="color" onclick="SetColorAndAccept('#A60000','colorContent','.content','background')"></a><a class="color" onclick="SetColorAndAccept('#008500','colorContent','.content','background')"></a><a class="color" onclick="SetColorAndAccept('#fedd6f','colorContent','.content','background')"></a>
                                <div class="setColor">
                                    <p>Если не нравятся цвета выше</p>
                                    <div>
                                        <input type="color" id="SetColorContent" oninput="SetColorChangeOpacityAndAccept('colorContent',this,'opacityContent','.content','background');">
                                    </div>
                                </div>
                                <div>
                                    <p>Прозрачность фона: <input id="rangeContent" type="range" min="0" max="1" step="0.1" value="1" oninput="SendOpacity('colorContent',this,'#rangeC','.content')"><a id="rangeC" style="font-family: Bodoni;">1</a></p>
                                </div>
                            </div>
                            <div class="backgroundStyle">
                                <p>Выберите цвет или загрузите фоновую картинку</p>
                                <a class="color" onclick="SetColorAndAccept('#FF7400','backgroundColor','body','background')"></a><a class="color" onclick="SetColorAndAccept('#A60000','backgroundColor','body','background')"></a><a class="color" onclick="SetColorAndAccept('#008500','backgroundColor','body','background')"></a><a class="color" onclick="SetColorAndAccept('#fedd6f','backgroundColor','body','background')"></a>
                                <div class="setColor">
                                    <p>Если не нравятся цвета выше</p>
                                    <div>
                                        <input type="color" id="SetColorB" oninput="SetColorChangeAndAccept('backgroundColor',this,'body','background');">
                                    </div>
                                </div>
                                <div class="clear" ></div>
                                <label class="loadImage buttonAll" id="loadImage" style="float: left;">
                                    <span class="button">Загрузить картинку</span>
                                    <input type="file" name="file" id="photo" accept="image/*" onchange="uploadBackgroundM(this)">
                                </label>
                                <span id="output"></span>
                            </div>
                        </div>
                        <div class="right">
                            <div class="color">
                                <p>Выберите цвет шрифта текста на статьях</p>
                                <a class="color" onclick="SetColor('#FF7400','colorTextArtic')"></a><a class="color" onclick="SetColor('#A60000','colorTextArtic')"></a><a class="color" onclick="SetColor('#008500','colorTextArtic')"></a><a class="color" onclick="SetColor('#fedd6f','colorTextArtic')"></a>
                                <div class="setColor">
                                    <p>Если не нравятся цвета выше</p>
                                    <div>
                                        <input type="color" id="SetColorTextAr" oninput="SetColorChange('colorTextArtic',this);">
                                    </div>
                                </div>
                            </div>
                            <div class="color">
                                <p>Выберите цвет шрифта автора на статьях</p>
                                <a class="color" onclick="SetColor('#FF7400','colorLoginUser')"></a><a class="color" onclick="SetColor('#A60000','colorLoginUser')"></a><a class="color" onclick="SetColor('#008500','colorLoginUser')"></a><a class="color" onclick="SetColor('#fedd6f','colorLoginUser')"></a>
                                <div class="setColor">
                                    <p>Если не нравятся цвета выше</p>
                                    <div>
                                        <input type="color" id="SetColorLoginAr" oninput="SetColorChange('colorLoginUser',this);">
                                    </div>
                                </div>
                            </div>
                            <div class="color">
                                <p>Выберите цвет заголовка на статьях</p>
                                <a class="color" onclick="SetColor('#FF7400','colorNameArtic')"></a><a class="color" onclick="SetColor('#A60000','colorNameArtic')"></a><a class="color" onclick="SetColor('#008500','colorNameArtic')"></a><a class="color" onclick="SetColor('#fedd6f','colorNameArtic')"></a>
                                <div class="setColor">
                                    <p>Если не нравятся цвета выше</p>
                                    <div>
                                        <input type="color" id="SetColorNameAr" oninput="SetColorChange('colorNameArtic',this);">
                                    </div>
                                </div>
                            </div>
                            <div class="color">
                                <p>Выберите цвет шрифта на кнопках</p>
                                <a class="color" onclick="SetColorAndAccept('#FF7400','buttonAllColor','.buttonAll','color')"></a><a class="color" onclick="SetColorAndAccept('#A60000','buttonAllColor','.buttonAll','color')"></a><a class="color" onclick="SetColorAndAccept('#008500','buttonAllColor','.buttonAll','color')"></a><a class="color" onclick="SetColorAndAccept('#fedd6f','buttonAllColor','.buttonAll','color')"></a>
                                <div class="setColor">
                                    <p>Если не нравятся цвета выше</p>
                                    <div>
                                        <input type="color" id="SetColorButton" oninput="SetColorChangeAndAccept('buttonAllColor',this,'.buttonAll','color');">
                                    </div>
                                </div>
                            </div>
                            <form action="standardStyle.php" method="POST"><input type="submit" class="buttonAll" value="Стандартный стиль"></form>
                        </div>
                    </div>
                </div>
            </div>
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