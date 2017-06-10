/**
 * Created by Данил on 26.05.2017.
 */
var countAR=0;
window.Hemispher='all';
function GetArticle(hem, button){
    if($('.divComment').css('opacity')!=0){
        $('.divComment').css('opacity','0');
    }
    window.dataOld=0;
    ClearDiv();
    if(window.oldButton!=null){
        window.oldButton.className='buttonAll';
    }
    button.className='buttonAllActive';
    window.oldButton=button;
    countAR=0;
    if(hem==='') {
        var data = "count=" + countAR;
        GetArticleAjax(data);
        window.Hemispher = 'all';
    }
    else{
        var data = "count=" + countAR + "&hem=" + hem;
        GetArticleAjax(data);
        window.Hemispher = hem;
    }
}
function UpdateArticle() {
    if(countAR=10) {
        if (window.Hemispher != 'all') {
            var data = "count=" + countAR + "&hem=" + window.Hemispher;
            GetArticleAjax(data);
        }
        else {
            var data = "count=" + countAR;
            GetArticleAjax(data);
        }
    }
}
function GetArticleAjax(data) {
    $.ajax({
        type: "POST",
        url: 'getArticle.php',
        data: data,
        success: function (data) {
            data = JSON.parse(data);
            if (data != false) {
                for (var i = 0; i < data.length; i++) {
                    var par = document.querySelector("#wrapper");
                    var div = document.createElement('div');
                    div.className = 'content';
                    countAR=data[i].id;
                    div.setAttribute('count',countAR);
                    var elem = document.createElement('p');
                    elem.className = 'loginUser';
                    var txt = data[i].login;
                    var textNode = document.createTextNode(txt);
                    elem.appendChild(textNode);
                    div.appendChild(elem);
                    elem = document.createElement('p');
                    elem.className = 'nameArticleNews';
                    txt = data[i].nameArticle;
                    textNode = document.createTextNode(txt);
                    elem.appendChild(textNode);
                    div.appendChild(elem);
                    elem = document.createElement('p');
                    elem.className = 'textArticleNews';
                    txt = data[i].textArticle;
                    textNode = document.createTextNode(txt);
                    elem.appendChild(textNode);
                    div.appendChild(elem);
                    elem = document.createElement('p');
                    elem.id='commentNews';
                    var countCom = document.createElement('p');
                    countCom.id = 'countCom'+data[i].id;
                    countCom.className='countCom';
                    elem.appendChild(countCom);
                    var input=document.createElement('input');
                    input.type='button';
                    input.id='btnComment';
                    input.title='Комментарии';
                    elem.appendChild(input);
                    var span = document.createElement('span');
                    span.className='timePublish';
                    span.innerHTML="Время публикации: <span>"+data[i].timePublish+"</span>";
                    elem.appendChild(span);
                    span = document.createElement('span');
                    span.className='datePublish';
                    span.innerHTML="Дата публикации: <span>"+data[i].datePublish+"</span>";
                    elem.appendChild(span);
                    div.appendChild(elem);
                    div.addEventListener('click',openComment);
                    par.appendChild(div);
                }
            }
        }
    });
}
function ClearDiv() {
    document.querySelector("#wrapper").innerHTML='';
}

function NotifMessage() {
    var linkMessage = document.querySelector('#linkMessage');
    var eventSource = new EventSource("notifMessage.php");

    eventSource.onmessage=function (e)  {
        var data=JSON.parse(e.data);
        if(data!==null){
            if(linkMessage.innerHTML.indexOf("+")>0){
                linkMessage.innerHTML='Сообщения';
            }
            linkMessage.innerHTML=linkMessage.innerHTML+' +'+data;
        }
        else{
            linkMessage.innerHTML='Сообщения';
        }
    }
}

function sendComment() {
    var textMessage=$('#write').val();
    document.querySelector('#write').value='';
    var data='loginUser='+window.LoginUser+'&nameArticle='+window.NameArticle+'&textComment='+textMessage+'&timePublish='+window.timePublish+'&datePublish='+window.datePublish;
    $.ajax({
        type: 'POST',
        url: 'sendComment.php',
        data: data,
        beforeSend: function (a,b) {
            $('#write').attr('placeholder','Отправляем...');
        },
        success: function (data) {
            data=JSON.parse(data);
            if(data) {
                $('#write').attr('placeholder', 'Отправлено');
            }
        }
    })
}
function CheckEnterCom(e) {
    if(e.keyCode==13){
        sendComment();
    }
}
function updateCountComArticle(content) {
    var eventSource = new EventSource('updateCountComArticle.php');

    eventSource.onmessage=function (e) {
        var data=JSON.parse(e.data);

        if(data!=null){
            for(var i=0;i<data.length;i++){
                document.querySelector('#countCom'+data[i].IdArticle).innerHTML = data[i].countCom;
            }
        }
    }
}