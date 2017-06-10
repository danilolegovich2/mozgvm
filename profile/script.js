function TransiotionToPersonal()
{	
	var security = document.querySelector(".security");
	var personal = document.querySelector(".personal");
	security.style.display = "none";
	personal.style.display = "block";
}
function TransiotionToSecurity()
{
	var security = document.querySelector(".security");
	var personal = document.querySelector(".personal");
	security.style.display = "block";
	personal.style.display = "none";
}
function CheckingPassword(f){ //Проверка пароля
    var pass = f.newPassword;
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
        window.flagPassword = false;
    }
    else if(matcher==null && pass.value.length>5)
    {
        field.style.display = "block";
        field.innerHTML = "Минимум 1 заглавная буква";
        window.flagPassword = false;
    }
    else if(matcher09==null && pass.value.length>5 && matcher!=null)
    {
        field.style.display = "block";
        field.innerHTML = "Минимум одна цифра";
        window.flagPassword = false;
    }
    else if(matcher1==null && pass.value.length>5 && matcher!=null && matcher09!=null)
    {
        field.style.display = "block";
        field.innerHTML = "Минимум 1 спецсимвол (!@#$%^*()_+\"№;%:?*=-)";
        window.flagPassword = false;
    }
    else{
        field.style.display = "none";
        window.flagPassword = true;
    }
}
function CheckingRepeatPassword(f){ // Проверка повторенного пароля
    if(f.newPassword.value != f.repeatPassword.value && (f.newPassword.value.length>0 || f.repeatPassword.value.length>0))
    {
        f.repeatPassword.style.boxShadow = "0 0 4px #7C0300";
        window.flagPasswordRepeat = false;
    }
    else
    {
        f.repeatPassword.style.boxShadow = "0 0 4px #009900";
        window.flagPasswordRepeat = true;
    }
}
function CheckingNickName(f){ //Проверка логина
    var nickName = f.value;
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
                url: '../phpScripts/checkingNickName.php',
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
                        window.flagName=false;
                    }
                }
            });
    }
}
function uploadLogin() {
    var text = $('#name').val();
    var data = 'newLogin='+text;
    var login = $('#checkingNickName');
    if(text.length>0 && window.flagName){
        $.ajax({
            type: 'POST',
            url: 'uploadDescriptionAndLogin.php',
            data: data,
            success: function (data) {
                data=JSON.parse(data);
                if(data){
                    if(login.css('opacity')=='0'){
                        login.css('opacity','1');
                    }
                    login.css('color','green');
                    login.html('Логин изменен');
                    login.animate({opacity: "0"},2000);
                }
                else{
                    if(login.css('opacity')=='0'){
                        login.css('opacity','1');
                    }
                    login.css('color','green');
                    login.html('Логин не был изменен'+data);
                    login.animate({opacity: "0"},2000);
                }
            }
        });
    }
}
function checkingOldPass(f) {
    var oldPass = f.password;
    var data = "oldPass="+oldPass.value;
    if(f.password.value.length>0) {
        $.ajax({
            type: 'POST',
            url: 'checkingPassword.php',
            data: data,
            success: function (data) {
                data=JSON.parse(data);
                if (data) {
                    oldPass.style.boxShadow = "0 0 4px #009900";
                    window.flagOldPass = true;
                }
                else {
                    oldPass.style.boxShadow = "0 0 4px #7c0300";
                    window.flagOldPass = false;
                }
            }
        });
    }
}
function Accept(f) {
    if(window.flagPassword && window.flagPasswordRepeat && window.flagOldPass){
        var newPass=f.newPassword;
        var data = "newPass="+newPass.value;
        $.ajax({
            type: 'POST',
            url: 'editPassword.php',
            data: data,
            success: function (data) {
                data=JSON.parse(data);
                if(data){
                    var fieldPass=document.querySelector('#acceptPass');
                    fieldPass.innerHTML="Пароль изменен";
                    fieldPass.style.color = 'green';
                    fieldPass.style.display = 'block';
                    f.newPassword.value="";
                    f.password.value = "";
                    f.repeatPassword.value = "";
                }
                else{
                    var fieldPass=document.querySelector('#acceptPass');
                    fieldPass.innerHTML="Не правильно введен старый пароль!";
                    fieldPass.style.color = 'red';
                    fieldPass.style.display = 'block';
                }
            }
        });
    }
    else{
        var fieldPass=document.querySelector('#acceptPass');
        fieldPass.innerHTML="Не правильно введен старый пароль!";
        fieldPass.style.color = 'red';
        fieldPass.style.display = 'block';
    }
}
function uploadDescription() {
    var text = $('#description').val();
    var description = $('#uploadDescriptionCheck');
    if(text.length>0) {
        var data = 'description=' + text;
        $.ajax({
            type: 'POST',
            url: 'uploadDescriptionAndLogin.php',
            data: data,
            success: function (data) {
                data = JSON.parse(data);
                if (data) {
                    if(description.css('opacity')=='0'){
                        description.css('opacity','1');
                    }
                    description.html('Описание загружено');
                    description.css('color', 'green');
                    description.animate({opacity: "0"},2000);
                }
                else {
                    if(description.css('opacity')=='0'){
                        description.css('opacity','1');
                    }
                    description.html('Описание не было загружено' + data);
                    description.css('color', 'red');
                    description.animate({opacity: "0"},2000);
                }
            }
        });
    }
}
function uploadPhoto(input) {
    var div=document.querySelector('#imageUser');
    div.style.background='inherit';
    var img=document.createElement('img');
    img.id='photoUser';
    div.appendChild(img);
    var span=document.createElement('span');
    span.innerHTML = '0%';
    span.id='progressBar';
    div.appendChild(span);
    var fd=new FormData();
    fd.append('file',input.files[0]);
    var reader = new FileReader();

    reader.onload=(function (aImg) {
        return function (e) {
            aImg.src=e.target.result;
        }
    })(img);
    reader.readAsDataURL(input.files[0]);

    uploadFile(fd,'uploadPhoto.php',$('#progressBar'),$('#photoUser'));
}

