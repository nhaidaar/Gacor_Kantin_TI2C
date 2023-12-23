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
        <?php foreach ($data['notification'] as $notification) { ?>
            <div class="notif-box">
                <div class="message-box">
                    <div class="message">
                        <?php if ($notification['status'] == 'pending') {
                            if ($notification['type'] == 'product') {
                                if ($_SESSION['level'] == 'admin') { ?>
                                    <span class="dot"></span><span class="user-name"><?= $notification['name'] ?></span> request <span class="user-name"> New Product - <?= $notification['product_name'] ?></span>
                                <?php } else { ?>
                                    <span class="dot"></span>Your request of <span class="user-name"> New Product - <?= $notification['product_name'] ?></span> is pending
                                <?php }
                            } else {
                                if ($_SESSION['level'] == 'admin') { ?>
                                    <span class="dot"></span><span class="user-name"><?= $notification['name'] ?></span> request <span class="user-name"><?= $notification['stocks'] ?> Stock(s) - <?= $notification['product_name'] ?></span>
                                <?php } else { ?>
                                    <span class="dot"></span>Your request of <span class="user-name"><?= $notification['stocks'] ?> Stock(s) - <?= $notification['product_name'] ?></span> is pending
                                <?php }
                            }
                        } else {
                            if ($notification['type'] == 'product') {
                                if ($_SESSION['level'] == 'admin') { ?>
                                    You have <?= $notification['status'] ?> <span class="user-name"> New Product - <?= $notification['product_name'] ?></span>
                                <?php } else { ?>
                                    Your request of <span class="user-name">New Product - <?= $notification['product_name'] ?></span> has been <?= $notification['status'] ?>
                                <?php }
                            } else {
                                if ($_SESSION['level'] == 'admin') { ?>
                                    You have <?= $notification['status'] ?> <span class="user-name"><?= $notification['stocks'] ?> Stock(s) - <?= $notification['product_name'] ?></span>
                                <?php } else { ?>
                                    Your request of <span class="user-name"><?= $notification['stocks'] ?> Stock(s) - <?= $notification['product_name'] ?></span> has been <?= $notification['status'] ?>
                        <?php }
                            }
                        } ?>
                    </div>
                    <div class="message-date"><?= date('D, d F Y', strtotime($notification['date'])) ?></div>
                </div>

                <?php if ($notification['status'] == 'pending') {
                    if ($notification['type'] == 'product') {
                        if ($_SESSION['level'] == 'admin') { ?>
                            <a href="<?= BASEURL . 'notification/productdetail/' . $notification['id'] ?>" class="view-button">View</a>
                        <?php }
                    } else {
                        if ($_SESSION['level'] == 'admin') { ?>
                            <a href="<?= BASEURL . 'notification/stockdetail/' . $notification['id'] ?>" class="view-button">View</a>
                <?php }
                    }
                } ?>
            </div>
        <?php } ?>
    </div>
</div>
</body>