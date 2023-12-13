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
                    <div class="title">Daily Transaction</div>
                </div>
                <div class="item-row">
                    <?php
                    $query = "SELECT 
                                COUNT(t.id) as total_tx
                            FROM 
                                transactions AS t
                            WHERE 
                                DATE(t.date) = DATE(NOW())";
                    $result = mysqli_query($koneksi, $query);
                    $row = mysqli_fetch_assoc($result);
                    ?>
                    <div class="income"><?= $row['total_tx'] ?> Transaction(s)</div>
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
            require 'class/product.php';
            $product = new Product($koneksi);
            $product->showPopularProduct();
            ?>
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
                    require 'class/transaction.php';
                    $transaction = new Transaction($koneksi);
                    $transaction->fetchAllTransaction(5);
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>

</html>