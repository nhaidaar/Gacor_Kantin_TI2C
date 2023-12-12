<?php
$id = $_GET['id'];
$query = "SELECT 
        t.id AS order_id, 
        TIME(t.date) AS order_time, 
        DATE(t.date) AS order_date, 
        p.product_name, ti.qty, p.selling_price, ti.total_price
        FROM transactions t
        INNER JOIN transaction_items ti ON t.id = ti.transactions_id
        INNER JOIN product p ON ti.product_id = p.id
        WHERE t.id = $id";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);
?>
<div class="content">
    <div class="header-fixed">
        <div class="htitle">
            Transaction
        </div>
    </div>
    <div class="header">
        <div class="htitle">
            Transaction
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
            <div class="modal-header">Detail Transaction</div>
            <div class="modal-content">
                <div class="product-row">
                    <div class="order-attribute">
                        Order ID
                    </div>
                    <?= $row['order_id'] ?>
                </div>
                <div class="product-row">
                    <div class="order-attribute">
                        Time
                    </div>
                    <?= $row['order_time'] ?>
                </div>
                <div class="product-row">
                    <div class="order-attribute">
                        Date
                    </div>
                    <?= $row['order_date'] ?>
                </div>
                <table class="tx-detail">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>@</th>
                            <th style="text-align: end; color: #1B1B1B;"><?= mysqli_num_rows($result) ?> Item(s)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php do { ?>
                            <tr>
                                <td><?= $row['product_name'] ?></td>
                                <td><?= $row['qty'] ?></td>
                                <td><?= $row['selling_price'] ?></td>
                                <td style="text-align: end;">IDR <?= $row['total_price'] ?></td>
                            </tr>
                        <?php } while ($row = mysqli_fetch_assoc($result)); ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-content" style="border-top: 2px #EBEBEB dashed;">
                <div class="product-row">
                    <div class="order-attribute">
                        Total Price
                    </div>
                    <?php
                    $query = "SELECT 
                    SUM(total_price) AS tagihan 
                    FROM transaction_items
                    WHERE transactions_id = $id";
                    $result = mysqli_query($koneksi, $query);
                    $row = mysqli_fetch_assoc($result);
                    ?>
                    IDR <?= $row['tagihan'] ?>
                </div>
            </div>
        </div>
        <!-- <div class="modal-footer">
                <div id="close-modal" class="modal-button" onclick="history.back()">Close</div>
            </div> -->
    </div>