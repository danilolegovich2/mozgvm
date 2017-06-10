<?php
if(isset($_SESSION['login'])&&$_SESSION['activation']==1){?>
    <div id="updateNotifMessage">
        <p>Вам новое сообщение от: </p>
    </div>
    <script src="../scriptNewMessage.js"></script>
    <script>
        $(document).ready(updateNotificationMessage())
    </script>
<?}?>