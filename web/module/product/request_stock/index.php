<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

require 'class/product.php';
$product = new Product($koneksi);
$row = $product->fetchProduct($id);
?>
<div class="content">
    <div class="header-fixed">
        <div class="htitle">
            Product
        </div>
    </div>
    <div class="header">
        <div class="htitle">
            Product
        </div>
    </div>
    <div class="container">
        <div class="product-row">
            <div onclick="history.back()" class="back-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                    <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.167 10h11.666m-7.5-4.167L4.167 10m4.166 4.167L4.167 10" />
                </svg>
                Back
            </div>
        </div>
        <div style="height: 32px;"></div>
        <div style="border: 1px #EBEBEB solid; border-radius: 16px;">
            <div class="modal-header">Request Stock</div>
            <div class="modal-content" style="gap: 24px;">
                <div id="drop-area">
                    <img src="assets/<?= $row['product_name'] ?>.png" style="width: 300px; height: 200px; object-fit:contain;">
                    <span style="font-weight:600; font-size: 18px;"><?= $row['product_name'] ?></span>
                </div>
                <div class="myform">
                    <label for="stock">Stock(s)</label>
                    <input type="number" name="stock" id="stock" style="border-radius: 8px; padding: 16px; border: 1px #E1E1E1 solid; " placeholder="0">
                </div>
            </div>
            <div class="modal-footer" style="display: flex; gap: 16px;">
                <div onclick="history.back()" class="request-stock" style="padding: 16px; font-weight:500;">Cancel</div>
                <div id="user-reqstock" class="request-stock" style="padding: 16px; background-color: #FFC300;">Request</div>
            </div>
        </div>
    </div>
</div>
</body>