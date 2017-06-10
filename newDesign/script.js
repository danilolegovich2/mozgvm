function SetColor(Color, dataP) {
    var data=dataP+'='+Color;
    SendStyleAjax(data);
}
function SetColorAndAccept(Color, dataP, selector, prop) {
    $(selector).css(prop,Color);
    var data=dataP+'='+Color;
    SendStyleAjax(data);
}
function SetColorChange(dataP,idItem) {
    var Color=idItem.value;
    var data=dataP+'='+Color;
    SendStyleAjax(data);
}
function SendOpacity(dataP,idItem,rangeA,selector) {
    var range=idItem.value;
    var color=$(selector).css('background-color');
    if(color.indexOf('rgba')>=0){
        color=getColor(color,true,range);
        $(selector).css('background-color',color);
    }
    else if(color!='transparent'){
        color=getColor(color,false,range)
        $(selector).css('background-color',color);
    }
    else{
        color="rgba(0,0,0,"+range+")";
        $(selector).css('background-color',color);
    }
    document.querySelector(rangeA).innerHTML=range;
    var data=dataP+'='+color;
    SendStyleAjax(data);
}
function getColor(color, flag,range) {
    if(flag){
        var rgba=color.substr(0,4);
        var index=color.indexOf(',');
        var red=color.substr(4,index-3);
        color = color.substr(index+1,color.length);
        index = color.indexOf(',');
        var green=color.substr(0,index+1);
        color = color.substr(index+1,color.length);
        index = color.indexOf(',');
        var blue = color.substr(0,index+1);
        color=rgba+red+green+blue+range+')';
    }
    else{
        var rgba=color.substr(0,3);
        var index=color.indexOf(',');
        var red=color.substr(3,index-2);
        color = color.substr(index+1,color.length);
        index = color.indexOf(',');
        var green=color.substr(0,index+1);
        color = color.substr(index+1,color.length);
        index = color.indexOf(')');
        var blue = color.substr(0,index);
        color=rgba+red+green+blue+','+range+')';
    }
    return color;
}
function SetColorChangeOpacityAndAccept(dataP,idItem,opacity,selector,prop) {
    var Color=idItem.value;
    var data=dataP+'='+Color+"&"+opacity+"=1";
    $(selector).css(prop,Color);
    SendStyleAjax(data);
}
function SetColorChangeAndAccept(dataP,idItem,selector,prop) {
    var Color=idItem.value;
    var data=dataP+'='+Color;
    $(selector).css(prop,Color);
    SendStyleAjax(data);
}
function SendStyleAjax(data) {
    $.ajax({
        type: 'POST',
        url: 'uploadStyle.php',
        data: data,
        beforeSend: function(jqXHR, settings){
            document.querySelector('#load').innerHTML='Загрузка стиля на сервер';
        },
        success: function (data) {
            document.querySelector('#load').innerHTML='Стиль загружен. Будет применен после перезагрузки страницы';
        }
    })
}
function uploadBackgroundM(input) {
    var file = input.files[0];
    var fd = new FormData();
    var span = $('#output');
    span.html('0%');
    fd.append('file',file);

    uploadBackground(fd,'uploadBackground.php',span);
}



