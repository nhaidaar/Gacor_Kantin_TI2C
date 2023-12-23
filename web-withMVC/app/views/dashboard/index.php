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
            $analytics = [
                [
                    'title' => 'Monthly Income',
                    'value' => $data['monthly_income'],
                    'percentage' => $data['monthly_income_percentage']
                ],
                [
                    'title' => 'Daily Income',
                    'value' => $data['daily_income'],
                    'percentage' => $data['daily_income_percentage']
                ],
                [
                    'title' => 'Daily Profit',
                    'value' => $data['daily_profit'],
                    'percentage' => $data['daily_profit_percentage']
                ]
            ];
            foreach ($analytics as $analytic) : ?>
                <div class="container">
                    <div class="title-row">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none">
                            <rect width="31" height="31" x=".5" y=".5" fill="#fff" rx="15.5" />
                            <rect width="31" height="31" x=".5" y=".5" stroke="#EBEBEB" rx="15.5" />
                            <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.5 13.5h15M16 21.833h-5a2.5 2.5 0 0 1-2.5-2.5v-6.666a2.5 2.5 0 0 1 2.5-2.5h10a2.5 2.5 0 0 1 2.5 2.5v4.166M21 23.5l1.667-1.666m-3.334 0L21 23.5m0-4.166V23.5m-7.5-6.667h-1.667" />
                        </svg>
                        <div class="title"><?= $analytic['title'] ?></div>
                    </div>
                    <div class="item-row">
                        <div class="income">IDR <?= $analytic['value']  ?></div>
                        <?php if ($analytic['percentage'] <= 0) { ?>
                            <div class="percentage-row">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" fill="none">
                                    <path stroke="#EC1A1A" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="m2.5 9.25 7-7m-7 1.865V9.25h5.135M1.75 11.5h8.5" />
                                </svg>
                                <div class="percentage">
                                    <?= abs($analytic['percentage']) . '%' ?>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="percentage-row" style="background-color: rgba(0, 115, 27, 0.12); border: 1.5px rgba(0, 115, 27, 0.5) solid;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" fill="none">
                                    <path stroke="#00731B" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M10.25 11.5h-8.5M9.5 2.25l-7 7m7-1.865V2.25H4.365" />
                                </svg>
                                <div class="percentage" style="color: #00731B;">
                                    <?= abs($analytic['percentage']) . '%' ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <div class="product-row">
            <div class="title">
                Popular Product
            </div>
            <a href="<?= BASEURL . 'product/' ?>" class="viewmore">
                View More
            </a>
        </div>
        <div style="height: 16px;"></div>
        <div class="product-list">
            <?php
            $data_product = $data['product'];
            foreach ($data_product as $product) : ?>
                <div class="product-container">
                    <div class="product-preview">
                        <div class="product-stock" <?= ($product['stocks'] < 10 ? 'style="color: #EC1A1A;"' : '') ?>>
                            <?= $product['stocks'] . ' Stock(s)' ?>
                        </div>
                        <img src="<?= BASEURL . 'assets/products/' . $product['product_name'] . '.png' ?>" class="product-img<?= ($product['stocks'] == 0 ? '-grayscale' : '') ?>">
                    </div>
                    <div class="product-detail">
                        <div class="product-name">
                            <?= $product['product_name'] ?>
                        </div>
                        <div class="product-category">
                            <?= $product['category_name'] ?>
                        </div>
                        <div class="product-price">
                            IDR <?= number_format($product['selling_price'], 2, ',', '.') ?>
                        </div>
                        <?php if ($_SESSION['level'] == 'admin') { ?>
                            <div class="product-button-row">
                                <a href="<?= BASEURL . 'product/edit/' . $product['id'] ?>">
                                    <div class="edit-product">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                                            <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m4.91 13.016 8.606-8.605a.833.833 0 0 1 1.177 0l1.397 1.397a.833.833 0 0 1 0 1.177l-8.606 8.604a.83.83 0 0 1-.588.244h-2.23v-2.229a.83.83 0 0 1 .245-.588Z" clip-rule="evenodd" />
                                            <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m11.958 5.967 2.575 2.575" />
                                        </svg>
                                        Edit Product
                                    </div>
                                </a>
                                <a href="<?= BASEURL . 'product/delete/' .  $product['id'] ?>">
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
                            <a href="<?= BASEURL . 'product/requeststock/' .  $product['id'] ?>">
                                <div class="request-stock">
                                    Request Stock
                                </div>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <div style="height: 40px;"></div>
        <div class="transaction">
            <table>
                <div class="transaction-row">
                    <div class="title">
                        Last Transaction
                    </div>
                    <a href="<?= BASEURL . 'transaction/' ?>">
                        <div class="viewmore">
                            View More
                        </div>
                    </a>
                </div>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Total Price</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data_transaction = $data['transaction'];
                    foreach ($data_transaction as $transaction) : ?>
                        <tr>
                            <td> #<?= sprintf('%08s', strtoupper(dechex($transaction['order_id']))) ?></td>
                            <td><?= date("d-m-Y", strtotime($transaction['transaction_date'])) ?></td>
                            <td><?= $transaction['transaction_time'] ?></td>
                            <td>IDR <?= number_format($transaction['total_price'], 2, ',', '.') ?></td>
                            <td class="transaction-detail">
                                <a class="seedetail" href="<?= BASEURL . 'transaction/checkdetails/' . $transaction['order_id'] ?>">See Detail</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>

</html>