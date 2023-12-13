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
        if ($_SESSION['level'] == 'admin') {
            $query = "SELECT * 
                    from 
                        add_product_log 
                    ORDER BY 
                        date DESC";
            $result = mysqli_query($koneksi, $query);
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <div class="notif-box">
                    <div class="message-box">
                        <div class="message"><span class="user-name">Naufal Haidar</span> request <span class="user-name"><?= $row['product_name'] ?></span> as new product</div>
                        <div class="message-date"><?= date('D, d F Y', strtotime($row['date'])); ?></div>
                    </div>
                    <a href="#" class="view-button">View</a>
                </div>
            <?php } ?>
            <?php } else {
            $query = "SELECT * 
            from 
                add_product_log 
            ORDER BY 
                date DESC";
            $result = mysqli_query($koneksi, $query);
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="notif-box">
                    <div class="message-box">
                        <div class="message user-name">Your request <span class="user-name"><?= $row['product_name'] ?></span> <?= $row['status'] == 'pending' ? 'is pending' : ($row['status'] == 'accept' ? 'has been approved' : 'has been rejected') ?></div>
                        <div class="message-date"><?= date('D, d F Y', strtotime($row['date'])); ?></div>
                    </div>
                </div>
        <?php }
        } ?>
    </div>
</div>
</body>