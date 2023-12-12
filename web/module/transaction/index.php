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
            <div></div>
            <div style="gap: 8px; display: flex;">
                <div class="edit-product">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                        <path stroke="#1B1B1B" stroke-linecap="round" stroke-width="1.5" d="M2.5 5.833h15M5 10h10m-6.667 4.167h3.334" />
                    </svg>
                    Filter
                </div>
                <a href="index.php?page=transaction/add_transaction/">
                    <div class="edit-product-yellow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                            <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 10h10m-5 5V5" />
                        </svg>
                        Add Transaction
                    </div>
                </a>
            </div>
        </div>
        <div style="height: 32px;"></div>

        <table class="transaction">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product</th>
                    <th>Time</th>
                    <th>Date</th>
                    <th>Total Price</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_GET['datestart']) && isset($_GET['dateend'])) {
                    $datestart = $_GET['datestart'];
                    $dateend = $_GET['dateend'];
                    $query = "SELECT 
                            t.id AS order_id,
                            GROUP_CONCAT(CONCAT(ti.qty, 'pcs ', p.product_name) SEPARATOR '\n') AS product,
                            TIME(t.date) AS transaction_time,
                            DATE(t.date) AS transaction_date,
                            SUM(ti.total_price) AS total_price
                        FROM 
                            transactions t
                        INNER JOIN 
                            transaction_items ti ON t.id = ti.transactions_id
                        INNER JOIN 
                            product p ON ti.product_id = p.id
                        WHERE
                            t.date BETWEEN $datestart AND $dateend
                        GROUP BY 
                            t.id
                        ORDER BY t.date DESC
                        ";
                } else {
                    $query = "SELECT 
                            t.id AS order_id,
                            GROUP_CONCAT(CONCAT(ti.qty, 'pcs ', p.product_name) SEPARATOR '\n') AS product,
                            TIME(t.date) AS transaction_time,
                            DATE(t.date) AS transaction_date,
                            SUM(ti.total_price) AS total_price
                        FROM 
                            transactions t
                        INNER JOIN 
                            transaction_items ti ON t.id = ti.transactions_id
                        INNER JOIN 
                            product p ON ti.product_id = p.id
                        GROUP BY 
                            t.id
                        ORDER BY t.date DESC
                        ";
                }
                $result = mysqli_query($koneksi, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?= $row['order_id']; ?></td>
                        <td><?= $row['product']; ?></td>
                        <td><?= $row['transaction_time']; ?></td>
                        <td><?= date("d-m-Y", strtotime($row['transaction_date'])); ?></td>
                        <td>IDR <?= number_format($row['total_price'], 2, ',', '.'); ?></td>
                        <td><a href="index.php?page=transaction/check_details&id=<?= $row['order_id']; ?>">View Detail</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<div id="modal" class="modal-transaction">
    <div class="modal-container">
        <div class="modal-header">
            Detail Transaction
        </div>
        <div class="modal-content">
            <div class="product-row">
                <div class="order-attribute">
                    Order ID
                </div>
                #00001234
            </div>
            <div class="product-row">
                <div class="order-attribute">
                    Time
                </div>
                #00001234
            </div>
            <div class="product-row">
                <div class="order-attribute">
                    Date
                </div>
                #00001234
            </div>
            <table class="tx-detail">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th style="text-align: end; color: #1B1B1B;">4 Items</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Teh Pucuk</td>
                        <td style="text-align: end;">IDR 2.500,00</td>
                    </tr>
                </tbody>
            </table>

        </div>
        <div class="modal-content" style="border-top: 2px #EBEBEB dashed;">
            <div class="product-row">
                <div class="order-attribute">
                    Total Price
                </div>
                #00001234
            </div>
        </div>
        <div class="modal-footer">
            <div id="close-modal" class="modal-button" onclick="closeModal()">Close</div>
        </div>
    </div>
</div>
<script src="script.js"></script>
</body>

</html>