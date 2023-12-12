<div class="content">
    <div class="header-fixed">
        <div class="htitle">
            Dashboard
        </div>
    </div>
    <div class="header">
        <div class="htitle">
            Dashboard
        </div>
    </div>
    <div class="container">
        <div class="analytics">
            <div class="container">
                <div class="title-row">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none">
                        <rect width="31" height="31" x=".5" y=".5" fill="#fff" rx="15.5" />
                        <rect width="31" height="31" x=".5" y=".5" stroke="#EBEBEB" rx="15.5" />
                        <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.5 13.5h15M16 21.833h-5a2.5 2.5 0 0 1-2.5-2.5v-6.666a2.5 2.5 0 0 1 2.5-2.5h10a2.5 2.5 0 0 1 2.5 2.5v4.166M21 23.5l1.667-1.666m-3.334 0L21 23.5m0-4.166V23.5m-7.5-6.667h-1.667" />
                    </svg>

                    <div class="title">Monthly Income</div>
                </div>
                <div class="item-row">
                    <?php
                    $query = "SELECT SUM(ti.total_price) AS monthly_income
                            FROM transactions AS t
                            INNER JOIN transaction_items AS ti ON t.id = ti.transactions_id
                            WHERE MONTH(t.date) = MONTH(CURRENT_DATE)";
                    $result = mysqli_query($koneksi, $query);
                    $row = mysqli_fetch_assoc($result);
                    ?>
                    <div class="income">IDR <?= $row['monthly_income']; ?></div>
                    <div class="percentage-row">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" fill="none">
                            <path stroke="#EC1A1A" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="m2.5 9.25 7-7m-7 1.865V9.25h5.135M1.75 11.5h8.5" />
                        </svg>

                        <div class="percentage">5%</div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="title-row">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none">
                        <rect width="31" height="31" x=".5" y=".5" fill="#fff" rx="15.5" />
                        <rect width="31" height="31" x=".5" y=".5" stroke="#EBEBEB" rx="15.5" />
                        <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.5 13.5h15M16 21.833h-5a2.5 2.5 0 0 1-2.5-2.5v-6.666a2.5 2.5 0 0 1 2.5-2.5h10a2.5 2.5 0 0 1 2.5 2.5v4.166M21 23.5l1.667-1.666m-3.334 0L21 23.5m0-4.166V23.5m-7.5-6.667h-1.667" />
                    </svg>

                    <div class="title">Daily Income</div>
                </div>
                <div class="item-row">
                    <?php
                    $query = "SELECT SUM(ti.total_price) AS daily_income
                            FROM transactions AS t
                            INNER JOIN transaction_items AS ti ON t.id = ti.transactions_id
                            WHERE DATE(t.date) = DATE(NOW())";
                    $result = mysqli_query($koneksi, $query);
                    $row = mysqli_fetch_assoc($result);
                    ?>
                    <div class="income">IDR <?= $row['daily_income'] != NULL ? $row['daily_income'] : 0 ?></div>
                    <div class="percentage-row">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" fill="none">
                            <path stroke="#EC1A1A" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="m2.5 9.25 7-7m-7 1.865V9.25h5.135M1.75 11.5h8.5" />
                        </svg>

                        <div class="percentage">5%</div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="title-row">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none">
                        <rect width="31" height="31" x=".5" y=".5" fill="#fff" rx="15.5" />
                        <rect width="31" height="31" x=".5" y=".5" stroke="#EBEBEB" rx="15.5" />
                        <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.5 13.5h15M16 21.833h-5a2.5 2.5 0 0 1-2.5-2.5v-6.666a2.5 2.5 0 0 1 2.5-2.5h10a2.5 2.5 0 0 1 2.5 2.5v4.166M21 19.334 19.333 21m3.334 0L21 19.334m0 4.166v-4.166m-7.5-2.501h-1.667" />
                    </svg>

                    <div class="title">Monthly Products Sold</div>
                </div>
                <div class="item-row">
                    <?php
                    $query = "SELECT COUNT(DISTINCT ti.product_id) AS monthly_products_sold
                    FROM transactions AS t
                    INNER JOIN transaction_items AS ti ON t.id = ti.transactions_id
                    WHERE MONTH(t.date) = MONTH(NOW()) AND YEAR(t.date) = YEAR(NOW())";
                    $result = mysqli_query($koneksi, $query);
                    $row = mysqli_fetch_assoc($result);
                    ?>
                    <div class="income"><?= mysqli_num_rows($result) !== 0 ? $row['monthly_products_sold'] : 0 ?> Product(s)</div>
                    <div class="percentage-row">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" fill="none">
                            <path stroke="#EC1A1A" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="m2.5 9.25 7-7m-7 1.865V9.25h5.135M1.75 11.5h8.5" />
                        </svg>

                        <div class="percentage">5%</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-row">
            <div class="title">
                Popular Product
            </div>
            <a href="index.php?page=product" class="viewmore">
                View More
            </a>
        </div>
        <div style="height: 16px;"></div>
        <div class="product-list">
            <?php
            $query = "SELECT * FROM product 
                        INNER JOIN category ON product.category_id = category.id 
                        LIMIT 4";
            $result = mysqli_query($koneksi, $query);
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="product-container">
                    <div class="product-preview">
                        <div class="product-stock" <?= $row['stocks'] < 10 ? 'style= "color: #EC1A1A;"' : '' ?>>
                            <?= $row['stocks'] ?> Stock(s)
                        </div>
                        <img src="assets/<?= $row['product_name'] ?>.png" class="product-img">
                    </div>
                    <div class="product-detail">
                        <div class="product-name">
                            <?= $row['product_name'] ?>
                        </div>
                        <div class="product-category">
                            <?= $row['category_name'] ?>
                        </div>
                        <div class="product-price">
                            IDR <?= number_format($row['selling_price'], 2, ',', '.'); ?>
                        </div>
                        <?php
                        if ($_SESSION['level'] == 'admin') {
                        ?>
                            <div class="product-button-row">
                                <a href="#">
                                    <div class="edit-product">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                                            <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m4.91 13.016 8.606-8.605a.833.833 0 0 1 1.177 0l1.397 1.397a.833.833 0 0 1 0 1.177l-8.606 8.604a.83.83 0 0 1-.588.244h-2.23v-2.229a.83.83 0 0 1 .245-.588Z" clip-rule="evenodd" />
                                            <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m11.958 5.967 2.575 2.575" />
                                        </svg>
                                        Edit Product
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="delete-product">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                                            <path stroke="#EC1A1A" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12.952 17.503H7.048c-.98 0-1.795-.755-1.87-1.732l-.805-10.46h11.254l-.804 10.46a1.876 1.876 0 0 1-1.87 1.732v0Z" clip-rule="evenodd" />
                                            <path stroke="#EC1A1A" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16.67 5.31H3.33" />
                                            <path stroke="#EC1A1A" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7.655 2.497h4.69c.518 0 .938.42.938.938V5.31H6.717V3.435c0-.518.42-.938.938-.938Z" clip-rule="evenodd" />
                                            <path stroke="#EC1A1A" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.641 9.062v4.69m-3.282-4.69v4.69" />
                                        </svg>
                                    </div>
                                </a>
                            </div>
                        <?php } else { ?>
                            <a href="#">
                                <div class="request-stock">
                                    Request Stock
                                </div>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div style="height: 40px;"></div>
        <div class="transaction">
            <table>
                <div class="transaction-row">
                    <div class="title">
                        Last Transaction
                    </div>
                    <a href="index.php?page=transaction">
                        <div class="viewmore">
                            View More
                        </div>
                    </a>
                </div>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Product</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Total Price</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
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
                    $result = mysqli_query($koneksi, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?= '#' . sprintf('%08s', strtoupper(dechex($row['order_id']))); ?></td>
                            <td><?= $row['product']; ?></td>
                            <td><?= date("d-m-Y", strtotime($row['transaction_date'])); ?></td>
                            <td><?= $row['transaction_time']; ?></td>
                            <td>IDR <?= number_format($row['total_price'], 2, ',', '.'); ?></td>
                            <td><a href="index.php?page=transaction/check_details&id=<?= $row['order_id']; ?>">See Detail</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="script.js"></script>
</body>

</html>