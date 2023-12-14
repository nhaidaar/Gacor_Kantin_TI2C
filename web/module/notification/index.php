<div class="content">
    <div class="header-fixed">
        <div class="htitle">
            Notification
        </div>
    </div>
    <div class="header">
        <div class="htitle">
            Notification
        </div>
    </div>
    <div class="container">
        <?php
        require 'class/notification.php';
        $notif = new Notification($koneksi);
        $notif->showNotification();
        ?>
    </div>
</div>
</body>