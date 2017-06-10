function FindInterlocutor() {
    var findField = $("#parentAddInter");
    if($('#parentAddInter').css('display')!='block') {
        var par = document.querySelector(".addInterlocutor");
        par.innerHTML = '';
        findField.css('display','block');
        var data = "countLogin=" + 0;
        $.ajax({
            type: 'POST',
            url: 'getLogin.php',
            data: data,
            success: function (data) {
                data = JSON.parse(data);
                if (data != false) {
                    for (var i = 0; i < data.length; i++) {
                        var par = document.querySelector(".addInterlocutor");
                        var elem = document.createElement('p');
                        var txt = data[i].login;
                        var textNode = document.createTextNode(txt);
                        elem.appendChild(textNode);
                        elem.addEventListener('click', addInterlocutor);
                        elem.className='buttonAll';
                        par.appendChild(elem);
                    }
                }
            }
        });
    }
    else{
        findField.css('display','none');
    }
}
function addInterlocutor() {
    var login = this.innerHTML;
    this.style.display='none';
    var data = "Login="+login;
    $.ajax({
        type: 'POST',
        url: 'addInterlocutor.php',
        data: data,
        success: function (data) {
            data=JSON.parse(data);
            if(data!=false){
                var par=document.querySelector(".sender");
                var elem=document.createElement('li');
                elem.className='buttonAll';
                var p = document.createElement('p');
                var a = document.createElement('a');
                a.id='recipient';
                var textNode = document.createTextNode(login);
                a.appendChild(textNode);
                p.appendChild(a);
                a=document.createElement('a');
                a.id=login;
                a.style.float='right';
                p.appendChild(a);
                elem.appendChild(p);
                elem.addEventListener('click', OpenDialog);
                par.appendChild(elem);
                FindInterlocutor();
            }
        }
    });

}
function getInterlocutor() {
    $.ajax({
        type: 'POST',
        url: 'getInterlocutor.php',
        success: function (data) {
            data=JSON.parse(data);
            if(data){
                for(var i=0;i<data.length;i++){
                    var par = document.querySelector(".sender");
                    var elem = document.createElement('li');
                    elem.className='buttonAll';
                    var txt = data[i].recipient;
                    window.NameLogin=data[i].sender;
                    var p = document.createElement('p');
                    var a = document.createElement('a');
                    p.style.display='table';
                    a.id='recipient';
                    a.style.display='table-cell';
                    var textNode = document.createTextNode(txt);
                    a.appendChild(textNode);
                    p.appendChild(a);
                    a=document.createElement('a');
                    a.id=txt;
                    a.style.display='table-cell';
                    a.style.paddingLeft='1vw';
                    p.appendChild(a);
                    elem.appendChild(p);
                    elem.addEventListener('click', OpenDialog);
                    par.appendChild(elem);
                }
            }
        }
    });
}
window.countDialog=0;
function OpenDialog() {
    window.countDialog++;
    window.recipientMessage=this.querySelector('#recipient').innerHTML;
    var data="Recipient="+this.querySelector('#recipient').innerHTML;
    var sender=document.querySelector("#"+window.recipientMessage);
    sender.innerHTML='';
    document.querySelector('#wrapper').innerHTML='';
    if(window.oldRecipient!=null){
        window.oldRecipient.className = 'buttonAll';
    }
    window.oldRecipient=this;
    this.className = "buttonAllActive";
    $.ajax({
        type: 'POST',
        url: 'getMessages.php',
        data: data,
        success: function (data) {
            data=JSON.parse(data);
            if(data!=false){
                for(var i=0;i<data.length;i++) {
                    window.countMessage++;
                    var par = document.querySelector("#wrapper");
                    var div = document.createElement('div');
                    var p = document.createElement('p')
                    p.className='sender';
                    p.innerHTML=data[i].sender;
                    div.appendChild(p);
                    p=document.createElement('p');
                    p.className='message';
                    p.id=window.countMessage;
                    p.innerHTML=data[i].textMessage+"<i>"+data[i].timeMessage+" "+data[i].dateMessage+"</i>";
                    div.appendChild(p);

                    if(data[i].attachedPhotos.length>0) {
                        var divImg = document.createElement('div');
                        divImg.className = 'attachedPhotoM';
                        $.each(data[i].attachedPhotos, function (i, fileName) {
                            var img = document.createElement('img');
                            img.src = 'images/' + fileName;
                            divImg.appendChild(img);
                        });
                        div.appendChild(divImg);
                    }
                    par.appendChild(div);
                }
                $('#wrapper').scrollTop($('#wrapper').prop('scrollHeight'));
            }
            else{
                var par=document.querySelector('#wrapper');
                var elem = document.createElement('p');
                elem.innerHTML="У вас пока нет сообщений с этим собеседником";
                par.appendChild(elem);
            }
            if(window.countDialog>1){
                UpdateMessage(false);
                UpdateMessage(true);
            }
            else{
                UpdateMessage(true);
            }

        }
    });
    $('#wrapper').scrollTop($('#wrapper').prop('scrollHeight'));
}
var fileName=[];
var attachedFile=[];
function sendMessage() {
    if(window.recipientMessage!=null) {
        var date = new Date();
        var message = $('#message').val();
        var flag=false;
        document.querySelector('#message').value = '';
        if (message.length > 0 || fileName.length>0) {
            var par = document.querySelector("#wrapper");
            if (par.innerHTML.indexOf("У вас пока нет сообщений с этим собеседником") > 0) {
                par.innerHTML = '';
            }
            var div = document.createElement('div');
            par.appendChild(div);
            $('#attachedPhotos').html('');
            if(fileName.length>0){
               var data = {'Message':message,'recipient':window.recipientMessage,'fileName[]':fileName};
               flag=true;
            }
            else {
                var data = "Message=" + message + "&recipient=" + window.recipientMessage;
            }

            $.ajax({
                type: 'POST',
                url: 'sendMessage.php',
                data: data,
                beforeSend: function () {
                    if(flag) {
                        div.innerHTML = "<p class='sender'>" + window.NameLogin + "<img src='ios7-clock-outline_icon-icons.com_50306.png' height='10px' width='10px' style='margin-left: 5px;'></p><p class='message'>" + message + "<i>" + addZero(date.getHours()) + ":" + addZero(date.getMinutes()) + ":" + addZero(date.getSeconds()) + " " + date.getFullYear() + "-" + addZero(date.getMonth() + 1) + "-" + addZero(date.getDate()) + "</i>" + "</p>";

                        var divImg = document.createElement('div');
                        divImg.className='attachedPhotoM';
                        $.each(attachedFile, function (i, file) {
                            var img = document.createElement('img');
                            divImg.appendChild(img);

                            var reader = new FileReader();

                            reader.onload=(function (aImg) {
                                return function (e) {
                                    aImg.src=e.target.result;
                                };
                            })(img);

                            reader.readAsDataURL(file);
                        });

                        div.appendChild(divImg);
                    }
                    else{
                        div.innerHTML = "<p class='sender'>" + window.NameLogin + "<img src='ios7-clock-outline_icon-icons.com_50306.png' height='10px' width='10px' style='margin-left: 5px;'></p><p class='message'>" + message + "<i>" + addZero(date.getHours()) + ":" + addZero(date.getMinutes()) + ":" + addZero(date.getSeconds()) + " " + date.getFullYear() + "-" + addZero(date.getMonth() + 1) + "-" + addZero(date.getDate()) + "</i>" + "</p>";
                    }
                    $('#wrapper').scrollTop($('#wrapper').prop('scrollHeight'));
                },
                success: function (data) {
                    if(flag) {
                        div.innerHTML = "<p class='sender'>" + window.NameLogin + "</p><p class='message'>" + message + "<i>" + addZero(date.getHours()) + ":" + addZero(date.getMinutes()) + ":" + addZero(date.getSeconds()) + " " + date.getFullYear() + "-" + addZero(date.getMonth() + 1) + "-" + addZero(date.getDate()) + "</i>" + "</p>";

                        var divImg = document.createElement('div');
                        divImg.className='attachedPhotoM';
                        $.each(attachedFile, function (i, file) {
                            var img = document.createElement('img');
                            divImg.appendChild(img);

                            var reader = new FileReader();

                            reader.onload=(function (aImg) {
                                return function (e) {
                                    aImg.src=e.target.result;
                                };
                            })(img);

                            reader.readAsDataURL(file);
                        });

                        div.appendChild(divImg);
                        fileName.length=0;
                        attachedFile.length=0;
                        countImg=0;
                    }
                    else{
                        div.innerHTML = "<p class='sender'>" + window.NameLogin + "</p><p class='message'>" + message + "<i>" + addZero(date.getHours()) + ":" + addZero(date.getMinutes()) + ":" + addZero(date.getSeconds()) + " " + date.getFullYear() + "-" + addZero(date.getMonth() + 1) + "-" + addZero(date.getDate()) + "</i>" + "</p>";
                    }
                }
            });
        }
    }
    else{
        var par = document.querySelector("#wrapper");
        par.innerHTML='<h1>Вы не выбрали собеседника</h1>';
    }
}
function UpdateNotifMessage() {
    var eventSource = new EventSource("updateNotifMessage.php");

    eventSource.onmessage=function (e) {
        var data=JSON.parse(e.data);
        if(data!==null){
            for(var i=0;i<data.length;i++){
                var sender=document.querySelector("#"+data[i].sender);
                if(data[i].count>0){
                    sender.innerHTML="+"+data[i].count;
                    playSound(data[i].count);
                }
                else{
                    sender.innerHTML='';
                }
            }
        }
    }
}
function addZero(i)
{
    if(i<10)
    {
        i="0"+i;
    }
    return i;
}
window.EventSourceUpdateMessage;
function UpdateMessage(flag) {
    if(flag){
        window.EventSourceUpdateMessage = new EventSource("updateMessage.php?sender="+window.recipientMessage);

        window.EventSourceUpdateMessage.onmessage=function (e) {
            var data = JSON.parse(e.data);
            if(data!=null){
                for(var i=0;i<data.length;i++){
                    var par = document.querySelector("#wrapper");
                    var div = document.createElement('div');
                    var p = document.createElement('p')
                    p.className='sender';
                    p.innerHTML=data[i].sender;
                    div.appendChild(p);
                    p=document.createElement('p');
                    p.className='message';
                    p.id=window.countMessage;
                    p.innerHTML=data[i].textMessage+"<i>"+data[i].timeMessage+" "+data[i].dateMessage+"</i>";
                    div.appendChild(p);

                    if(data[i].attachedPhotos.length>0) {
                        var divImg = document.createElement('div');
                        divImg.className = 'attachedPhotoM';
                        $.each(data[i].attachedPhotos, function (i, fileName) {
                            var img = document.createElement('img');
                            img.src = 'images/' + fileName;
                            divImg.appendChild(img);
                        });
                        div.appendChild(divImg);
                    }
                    par.appendChild(div);
                }
                $('#wrapper').scrollTop($('#wrapper').prop('scrollHeight'));
            }
        }
    }
    else{
        window.EventSourceUpdateMessage.close();
    }
}
function CheckEnter(e){
    if(e.keyCode==13){
        sendMessage();
    }
}
var IdImg=[];
var IdSpan=[];
var countImg=0;
var countSpanDel=0;
function uploadImage(input) {
    if(input.files.length<=15) {
        if(document.querySelector('#attachedPhotos').innerHTML.indexOf('Нельзя больше 15 изображений')>=0) {
            document.querySelector('#attachedPhotos').innerHTML = '';
            fileName.length=0;
            attachedFile.length=0;
            countImg=0;
        }
        $.each(input.files, function (i, file) {
            var date = new Date();
            var list = document.querySelector('#attachedPhotos');
            var div = document.createElement('div');
            div.className = 'attachedPhoto';
            div.id=countSpanDel;
            var img = document.createElement('img');
            img.id= date.getSeconds()+''+date.getMinutes()+''+date.getMilliseconds()*Math.round(Math.random()*100);
            img.file=file;
            IdImg.push(img.id);
            div.appendChild(img);
            var span = document.createElement('span');
            span.innerHTML = '0%';
            span.id=date.getSeconds()+''+date.getMinutes()+''+date.getMilliseconds()*Math.round(Math.random()*100)+'span';
            IdSpan.push(span.id);
            div.appendChild(span);
            var imgClose = document.createElement('img');
            imgClose.id=countSpanDel;
            imgClose.className='spanDel';
            imgClose.src='../images/close.png';
            imgClose.addEventListener('click',delAttachedPhoto);
            div.appendChild(imgClose);
            list.appendChild(div);

            var reader = new FileReader();
            reader.onload = (function (aimg) {
                return function (e) {
                    aimg.src = e.target.result;
                };
            })(img);

            reader.readAsDataURL(file);
            countSpanDel++;
        });
        $.each(input.files, function (i,file) {
            var date = new Date();
            var  fileName1=date.getSeconds()+''+date.getMinutes()+''+date.getMilliseconds()+''+file.name
            fileName.push(fileName1);

            attachedFile.push(file);
            var span = $('#'+IdSpan[countImg]);
            var img = $('#'+IdImg[countImg]);

            var fd=new FormData();

            fd.append("file",file);
            fd.append("fileName",fileName1);

            $.ajax({
                type: "POST",
                url: 'uploadImageMessage.php',
                data: fd,
                processData: false,
                contentType: false,
                xhr: function () {
                    var xhr=$.ajaxSettings.xhr();
                    xhr.upload.addEventListener('progress', function (e) {
                        span.html(Math.round((e.loaded/e.total)*100)+'%');
                    },false);
                    return xhr;
                },
                success: function () {
                    span.css('opacity','0');
                    img.css('opacity','1');
                }
            });
            countImg++;

          //  uploadFile(file,'uploadImageMessage.php',span,img,fileName[i]);
        });
        input.value=null;
    }
    else{
        input.value=null;
        fileName.length=0;
        countImg=0;
        attachedFile.length=0;
        var list = document.querySelector('#attachedPhotos');
        list.innerHTML='Нельзя больше 15 изображений';
        list.style.color='red';
    }
}
function delAttachedPhoto() {
    var spanId = this.id;
    $('div#'+spanId).css('display','none');
    fileName.splice(spanId,1);
    attachedFile.splice(spanId,1);
}
function updateNotificationMessageOnMessagePhp() {
    var eventSource = new EventSource('../phpScripts/updateNotificationMessage.php');

    eventSource.onmessage=function (e) {
        var data = JSON.parse(e.data);
        if(data!=null){
            var soundM = new Audio();
            soundM.volume = 1;
            soundM.load();
            soundM.src = '../sound/Message.wav';
            soundM.play();
        }
    }
}