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
            <div style="display: flex; gap: 12px;">
                <div style="display: flex; gap: 8px; align-items:center;">
                    <label for="startDate">From : </label>
                    <input type="date" name="startDate" id="startDate" value="<?= date('Y-m-d') ?>" style="border-radius: 8px; padding: 16px; border: 1px #E1E1E1 solid;">
                </div>
                <div style="display: flex; gap: 8px; align-items:center;">
                    <label for="endDate">To : </label>
                    <input type="date" name="endDate" id="endDate" value="<?= date('Y-m-d') ?>" style="border-radius: 8px; padding: 16px; border: 1px #E1E1E1 solid;">
                </div>
            </div>
            <div style="gap: 8px; display: flex;">
                <?php if ($_SESSION['level'] == 'user') { ?>
                    <a href="<?= BASEURL . 'transaction/add' ?>">
                        <div class="edit-product-yellow">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                                <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 10h10m-5 5V5" />
                            </svg>
                            Add Transaction
                        </div>
                    </a>
                <?php } ?>
            </div>
        </div>
        <div style="height: 32px;"></div>

        <table class="transaction">
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
                        <td id="date"><?= date("d-m-Y", strtotime($transaction['transaction_date'])) ?></td>
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
<script>
    // DATE FILTER
    // $(document).ready(function() {
    //     const startDateInput = document.getElementById('startDate');
    //     const endDateInput = document.getElementById('endDate');
    //     const transactions = document.querySelectorAll('table tbody tr')

    //     function filterDate() {
    //         const startDate = new Date(startDateInput.value);
    //         const endDate = new Date(endDateInput.value);

    //         transactions.forEach(row => {
    //             const dateCell = row.querySelector('#date');
    //             const date = new Date(dateCell);

    //             if (date >= startDate && date <= endDate) {
    //                 row.style.display = ''
    //             } else {
    //                 row.style.display = 'none'
    //             }
    //         })
    //     }

    //     startDateInput.onchange(function() {
    //         filterDate();
    //     })
    // });
</script>
</body>

</html>