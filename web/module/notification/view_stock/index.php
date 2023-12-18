<?php
$id = $_GET['id'];
$result = $notif->fetchStockNotification($id);
$row = mysqli_fetch_assoc($result);
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
                    <img src="assets/<?= $row['product_name'] ?>.png" style="width: 400px; height: 300px; object-fit:contain;">
                </div>
                <div style="height: 12px;"></div>
                <div class="product-row">
                    <div class="order-attribute">
                        Product Name
                    </div>
                    <?= $row['product_name'] ?>
                </div>
                <div class="product-row">
                    <div class="order-attribute">
                        Stock
                    </div>
                    <?= $row['stocks'] ?>
                </div>
            </div>
            <div class="modal-footer" style="display: flex; gap: 16px;">
                <div data-id="<?= $id ?>" id="reject-stock" class="request-stock" style="padding: 16px; background-color: #EC1A1A; color:#FFF;">Reject</div>
                <div data-id="<?= $id ?>" id="approve-stock" class="request-stock" style="padding: 16px; background-color: #FFC300;">Approve</div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#approve-stock').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                type: "POST",
                url: "fungsi/approve_stock.php",
                data: {
                    id: id
                },
                success: function(response) {
                    window.location.href = "index.php?page=notification";
                }
            });
        });
        $('#reject-stock').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                type: "POST",
                url: "fungsi/reject_stock.php",
                data: {
                    id: id
                },
                success: function(response) {
                    window.location.href = "index.php?page=notification";
                }
            });
        });
    });
</script>
</body>

</html>