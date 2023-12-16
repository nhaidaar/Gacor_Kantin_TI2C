<?php
require 'class/analytics.php';
require 'class/product.php';
require 'class/transaction.php';
$analytics = new Analytics($koneksi);
$product = new Product($koneksi);
$transaction = new Transaction($koneksi);
?>
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
            <?php
            $analytics->monthlyIncome();
            $analytics->dailyIncome();
            $analytics->dailyProfit();
            ?>
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
                    $transaction->fetchAllTransaction(5);
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>

</html>