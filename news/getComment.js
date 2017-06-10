var timerId;
var oldAr=0;
var countCom=0;
function openComment(e) {
    countCom=0;
    var target = e.target;
    var thisCount = this.getAttribute('count');
    document.querySelector('#wrapperCom').innerHTML='';
    clearTimeout(timerId);
    while (target != this){
        if(target.id=='btnComment'){
            if ($('.divComment').css('opacity') != 0 && !(thisCount!=oldAr)) {
                $('.divComment').css('opacity', '0');
            }
            else {
                $('#wrapperCom').scrollTop($('#wrapperCom').prop('scrollHeight'));
                $('.divComment').css('opacity', '1');
                var loginUser = this.children[0].innerHTML;
                var nameArticle = this.children[1].innerHTML;
                window.LoginUser=loginUser;
                window.NameArticle=nameArticle;
                document.querySelector('#descriptionComment').innerHTML="<span>"+nameArticle+"</span>";
                var item = this.children[3];
                window.timePublish=item.children[2].children[0].innerHTML;
                window.datePublish=item.children[3].children[0].innerHTML;
                getComment()
            }
            break;
        }
        target = target.parentNode;
        if($('.divComment').css('opacity')!=0){
            $('.divComment').css('opacity','0');
        }
    }
    oldAr=thisCount;
}

function getComment() {
    var data='loginUser='+window.LoginUser+'&nameArticle='+window.NameArticle+'&count='+countCom+'&timePublish='+window.timePublish+'&datePublish='+window.datePublish;
    $.ajax({
        type: 'POST',
        url: 'getComment.php',
        data: data,
        success: function (data) {
            data=JSON.parse(data);
            if(data!=null){
                for(var i=0;i<data.length;i++){
                    var div=document.createElement('div');
                    div.id='comment';
                    var p = document.createElement('p');
                    p.id='login';
                    p.innerHTML = data[i].LoginUser;
                    div.appendChild(p);
                    p=document.createElement('p');
                    p.id='text';
                    p.innerHTML=data[i].TextComment;
                    div.appendChild(p);
                    p=document.createElement('p');
                    p.id='datetime';
                    p.innerHTML=data[i].TimeComment+" "+data[i].DateComment;
                    div.appendChild(p);
                    document.querySelector('#wrapperCom').appendChild(div);
                    var max=data[i].id;
                }
                countCom=max;
            }
        }
    });
    timerId=setTimeout('getComment()',1000);
}
