function uploadFile(fd,url,span,img) {
    $.ajax({
        type: "POST",
        url: url,
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
}
function uploadBackground(fd,url,span) {
    $.ajax({
        type: "POST",
        url: url,
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
        success: function (data) {
            span.css('opacity','0');
            document.querySelector('body').style.background="url('"+data+"')";
        }
    });
}

