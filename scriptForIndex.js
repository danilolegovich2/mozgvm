function clickAuth(){ //Переход на форму авторизации
	var login = document.querySelector('.login');
	login.style.display="block";
	var auth = document.querySelector('.auth');
	auth.style.display="none";
}

function clickLogin(){ //Переход на форму регистрации
	var login = document.querySelector('.login');
	login.style.display="none";
	var auth = document.querySelector('.auth');
	auth.style.display="block";
}

function CheckingPassword(f){ //Проверка пароля
	var flag=false;
	var pass = f.password;
	var field = document.querySelector("#checkingPassword");
	var patternAZ = /[A-ZА-Я]+/g;
	var patternSpec = /[!@#$%^*()_+"№;%:?*=-]+/g;
    var pattern09 = /[0-9]+/i;
	var matcher = pass.value.match(patternAZ);
	var matcher1 = pass.value.match(patternSpec);
    var matcher09 = pass.value.match(pattern09);
	if(pass.value.length<6 && pass.value.length>0){
		field.style.display = "block";
		field.innerHTML = "Минимум 6 символов";
		flag = false;
	}
	else if(matcher==null && pass.value.length>5)
	{
		field.style.display = "block";
		field.innerHTML = "Минимум 1 заглавная буква";
		flag = false;
	}
    else if(matcher09==null && pass.value.length>5 && matcher!=null)
    {
        field.style.display = "block";
        field.innerHTML = "Минимум одна цифра";
        flag = false;
    }
	else if(matcher1==null && pass.value.length>5 && matcher!=null && matcher09!=null)
	{
		field.style.display = "block";
		field.innerHTML = "Минимум 1 спецсимвол (!@#$%^*()_+\"№;%:?*=-)";
		flag = false;
	}
	else{
		field.style.display = "none";
		flag = true;
	}
	window.flagCheckingPassword = flag;
}


function CheckingRepeatPassword(f){ // Проверка повторенного пароля
	if(f.password.value.length>0 && f.repeatPassword.value.length>0) {
        if (f.password.value != f.repeatPassword.value) {
            f.repeatPassword.style.boxShadow = "0 0 4px #cc0300";
            window.flagCheckingRepeatPassword = false;
        }
        else {
            f.repeatPassword.style.boxShadow = "0 0 4px #009900";
            window.flagCheckingRepeatPassword = true;
        }
    }
}

function RepeatPasswordOnBlur(pass) {
	if(!pass.length>0){
		pass.style.boxShadow="0 0 4px #000";
	}
}

function CheckingNickName(f){ //Проверка логина
	var nickName = f.name.value;
	var field = document.querySelector("#checkingNickName");
	if(nickName.length == 0)
	{
		field.style.display = "none";
	}
	else if (nickName.length<4)
	{
	    field.style.display = "block";
		field.innerHTML = "Минимум 4 символа";
		field.style.color = "rgb(124,3,0)";
		window.flagName=false;
	}
	else if(nickName.length>=4)
	{
		field.innerHTML = "";
		var data="nickName="+nickName;
		$.ajax(
		{
			type: 'POST',
			url: 'phpScripts/checkingNickName.php',
			data: data,
			success: function(data){
				data=JSON.parse(data);
				var field = document.querySelector("#checkingNickName");
				if(data)
				{		
					field.style.display = "block";
					field.innerHTML = "Ник свободен";
					field.style.color = "green";
					window.flagName=true;
				}
				else
				{
					field.style.display = "block";
					field.innerHTML = "Ник занят";
					field.style.color = "rgb(124,3,0)";
					window.flagName=true;
				}
			}
		});
	}
}

function CheckingEmail(f){ //Проверка email на уникальность
	var data = "Email="+f.email.value;
	$.ajax(
	{
		type: 'POST',
		url: 'phpScripts/checkingEmail.php',
		data: data,
		success: function (data){
            data=JSON.parse(data);
			var field = document.querySelector("#checkingEmail");
			if(!data)
			{
				field.innerHTML="Пользователь с таким email уже зарегистрирован";
				field.style.display = "block";
				window.flagEmail = false;
			}
			else
			{
                field.style.display = "none";
				window.flagEmail = true;
                var email = f.email.value;
                var emailCheckingField = document.querySelector("#checkingEmail");
                var pattern = /^[a-z0-9_\.-]+@[a-z0-0-]+\.[a-z]{2,4}$/i;
                emailCheckingField.innerHTML = "";
                if (!pattern.test(email) && email.length > 0) {
                    emailCheckingField.innerHTML = "Не правильный формат email";
                    emailCheckingField.style.display = "block";
                    window.flagEmailBlur = false;
                }
                else {
                    emailCheckingField.style.display = "none";
                    window.flagEmailBlur = true;
                }
			}
		}
	});
}

function Registration(f){ //обработка нажатия кнопки зарегистрироваться
	var email = f.email.value;
	var password = f.password.value;
	var repeatPassword = f.repeatPassword;
	var name = f.name.value;
		
	if(email!='' && password!='' && repeatPassword.value!='' && name!=''){
		if(window.flagCheckingRepeatPassword && window.flagCheckingPassword && window.flagEmailBlur && window.flagEmail && window.flagName && flagEmailBlur)
		{
			var data="Email="+email+"&Password="+password+"&Login="+name;
			$.ajax({
				type: 'POST',
				url: 'phpScripts/registration.php',
				data: data,
				success: function(data){
					data=JSON.parse(data)
					if(data) {
                        document.querySelector('.auth').innerHTML="Что бы активировать аккаунт перейдите на почту";
                    }
				}
			});		
		}
		else
		{
			return;
		}
	}
}

function Login(){//Обработчик для кнопки войти
	var formLogin = document.forms.login;
	var checkingLogin = document.querySelector("#checkingLogin");
	var login = formLogin.login;
	var pass = formLogin.password;
	var data = "Login="+login.value+"&Password="+pass.value;
	if(pass.value.length>0 && login.value.length>0){
		checkingLogin.style.display="none";
		$.ajax({
			type: 'POST',
			url: 'phpScripts/login.php',
			data: data,
			dataType: 'json',
			success: function(data){
                data=JSON.parse(data);
				if(data){
					checkingLogin.style.display="none";
					location.href='../news/news.php';
				}
				else if(data==='не нашел совпадений')
				{
					checkingLogin.style.display="block";
					checkingLogin.innerHTML="Не правильный логин или пароль";
					return;
				}
			}
		});
	}
	else
	{
		checkingLogin.style.display = "block";
		checkingLogin.innerHTML = "Заполните все поля";
		return;
	}
}
function CheckingLogin() {
	$.ajax({
		type: 'POST',
		url: 'phpScripts/checkingLogin.php',
		success: function (data) {
			data=JSON.parse(data);
			if(data===true){
				location.href='news/news.php';
			}
        }
	})
}
function CheckEnter(e) {
	if(e.keyCode==13){
		Login();
	}
}