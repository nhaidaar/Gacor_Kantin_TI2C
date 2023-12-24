<?php
$stock = $data['stock'];
?>
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
        <div class="product-row">
            <div onclick="history.back()" class="back-button" style="cursor:pointer; border-radius: 64px; padding: 10.5px 16px; border: 1px #EBEBEB solid; display: flex; align-items: center; gap: 8px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                    <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.167 10h11.666m-7.5-4.167L4.167 10m4.166 4.167L4.167 10" />
                </svg>
                Back
            </div>
        </div>
        <div style="height: 32px;"></div>
        <div style="border: 1px #EBEBEB solid; border-radius: 16px;">
            <div class="modal-header">Request Stock</div>
            <div class="modal-content">
                <div id="drop-area">
                    <img src="<?= BASEURL . 'assets/products/' . $stock['product_name'] ?>.png" style="width: 400px; height: 300px; object-fit:contain;">
                </div>
                <div style="height: 12px;"></div>
                <div class="product-row">
                    <div class="order-attribute">
                        Product Name
                    </div>
                    <?= $stock['product_name'] ?>
                </div>
                <div class="product-row">
                    <div class="order-attribute">
                        Stock
                    </div>
                    <?= $stock['stocks'] ?>
                </div>
            </div>
            <div class="modal-footer" style="display: flex; gap: 16px;">
                <?php if ($stock['status'] == 'pending') { ?>
                    <a href="<?= BASEURL . 'product/requeststock_approval/' . $stock['id'] . '/rejected' ?>" class="request-stock" style="padding: 16px; background-color: #EC1A1A; color:#FFF;">
                        Reject
                    </a>
                    <a href="<?= BASEURL . 'product/requeststock_approval/' . $stock['id'] . '/approved' ?>" class="request-stock" style="padding: 16px; background-color: #FFC300;">
                        Approve
                    </a>
                <?php } else { ?>
                    <div class="request-stock" style="padding: 16px; cursor: not-allowed;"><?= strtoupper($stock['status']) ?></div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
</body>

</html>