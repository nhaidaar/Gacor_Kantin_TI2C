<?php
$product = $data['product'];
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
            <form action="<?= BASEURL . 'product/deleteproduct_send' ?>" method="post">
                <div class="modal-header">Delete Product</div>
                <div class="modal-content" style="gap: 24px;">
                    <div id="drop-area">
                        <input type="number" name="id" value="<?= $product['id'] ?>" hidden>
                        <img src="<?= BASEURL . 'assets/products/' . $product['product_name'] . '.png' ?>" style="width: 300px; height: 200px; object-fit:contain;">
                        <span style="font-weight:600; font-size: 18px;"><?= $product['product_name'] ?></span>
                    </div>
                    <span style="font-weight:600; font-size: 20px; text-align: center;">Would you like to delete this product?</span>
                </div>
                <div class="modal-footer" style="display: flex; gap: 16px;">
                    <div onclick="history.back()" class="request-stock" style="padding: 16px; font-weight:500;">Cancel</div>
                    <button type="submit" id="delete-product" class="request-stock" style="padding: 16px; background-color: #EC1A1A; color:#FFF;">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>

</html>