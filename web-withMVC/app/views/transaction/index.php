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
                <div onclick="openModal()" class="edit-product" id="filter">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                        <path stroke="#1B1B1B" stroke-linecap="round" stroke-width="1.5" d="M2.5 5.833h15M5 10h10m-6.667 4.167h3.334" />
                    </svg>
                    Filter
                </div>
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
                if ($data_transaction == null) { ?>
                    <tr>
                        <td>No results found.</td>
                    </tr>
                <?php }
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

<div id="modal" class="modal-transaction">
    <div class="modal-container">
        <div class="modal-header">
            Filter by Date
        </div>
        <form action="<?= BASEURL . 'transaction/' ?>" method="post">
            <div class="modal-content" style="display: flex; gap: 12px;">
                <div class="myform">
                    <label for="start">From :</label>
                    <input type="date" name="start" id="start" value="<?= isset($_POST['start']) ? $_POST['start'] : '' ?>" style="border-radius: 8px; padding: 16px; border: 1px #E1E1E1 solid;">
                </div>
                <div class="myform">
                    <label for="end">To :</label>
                    <input type="date" name="end" id="end" value="<?= isset($_POST['end']) ? $_POST['end'] : '' ?>" style=" border-radius: 8px; padding: 16px; border: 1px #E1E1E1 solid;">
                </div>
            </div>
            <div class="modal-footer" style="display: flex; gap: 14px;">
                <div onclick="closeModal()" class="request-stock">Close</div>
                <button type="submit" id="submit" class="request-stock" style="background-color: #FFC300;">Submit</button>
            </div>
        </form>
    </div>
</div>
<script>
    // Modal Controller
    function openModal() {
        var modal = document.getElementById('modal');
        modal.style.display = 'flex';
    }

    function closeModal() {
        var modal = document.getElementById('modal');
        modal.style.display = 'none';
    }

    window.onclick = function(event) {
        var modal = document.getElementById('modal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    };
</script>
</body>

</html>