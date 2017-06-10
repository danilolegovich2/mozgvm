function updateNotificationMessage() {
    var eventSource = new EventSource('../phpScripts/updateNotificationMessage.php');
    
    eventSource.onmessage=function (e) {
        var data = JSON.parse(e.data);
        if(data!=null){
            var soundM = new Audio();
            soundM.volume = 1;
            soundM.load();
            soundM.src = '../sound/Message.wav';
            soundM.play();
            document.querySelector('#updateNotifMessage').innerHTML = 'Вам новое сообщение от: ';
            if($('#updateNotifMessage').css('opacity')>0){
                $('#updateNotifMessage').css('opacity','0');
            }
            $('#updateNotifMessage').animate({opacity: "1"},300);
            for (var i = 0; i < data.length; i++) {
                if (i != data.length - 1) {
                    document.querySelector('#updateNotifMessage').innerHTML += "<span id='senderMessage'>" + data[i].sender + ", " + "</span>";
                }
                else {
                    document.querySelector('#updateNotifMessage').innerHTML += "<span id='senderMessage'>" + data[i].sender + "</span>";
                }
            }
            $('#updateNotifMessage').animate({opacity: "0"},1500);

        }
    }
}
