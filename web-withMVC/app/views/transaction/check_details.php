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
                <?php
                $transaction = $data['transaction'];
                ?>
                <div class="product-row">
                    <div class="order-attribute">
                        Order ID
                    </div>
                    #<?= sprintf('%08s', strtoupper(dechex($transaction['order_id']))) ?>
                </div>
                <div class="product-row">
                    <div class="order-attribute">
                        Time
                    </div>
                    <?= $transaction['order_time'] ?>
                </div>
                <div class="product-row">
                    <div class="order-attribute">
                        Date
                    </div>
                    <?= date("d-m-Y", strtotime($transaction['order_date'])) ?>
                </div>
                <table class="tx-detail" style="border: 1px #EBEBEB solid;">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>@</th>
                            <th style="text-align: end; color: #1B1B1B;"><?= $transaction['item_count'] ?> Item(s)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['items'] as $item) : ?>
                            <tr>
                                <td><?= $item['product_name'] ?></td>
                                <td><?= $item['qty'] ?></td>
                                <td><?= $item['selling_price'] ?></td>
                                <td style="text-align: end;">IDR <?= number_format($item['total_price'], 2, ',', '.') ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-content" style="border-top: 2px #EBEBEB dashed;">
                <div class="product-row">
                    <div class="order-attribute">
                        Total Price
                    </div>
                    IDR <?= number_format($transaction['total_price'], 2, ',', '.') ?>
                </div>
            </div>
        </div>
    </div>