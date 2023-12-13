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
                require 'class/transaction.php';
                $transaction = new Transaction($koneksi);

                if (isset($_GET['datestart']) && isset($_GET['dateend'])) {
                    $transaction->fetchTransactionByDate($_GET['datestart'], $_GET['dateend']);
                } else {
                    $transaction->fetchAllTransaction(null);
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<div id="modal" class="modal-transaction">
    <div class="modal-container">
        <div class="modal-header">
            Filter by Date
        </div>
        <div class="modal-content" style="display: flex; gap: 12px;">
            <div class="myform">
                <label for="datestart">Date start :</label>
                <input type="date" name="datestart" id="datestart" style="border-radius: 8px; padding: 16px; border: 1px #E1E1E1 solid;">
            </div>
            <div class="myform">
                <label for="dateend">Date end :</label>
                <input type="date" name="dateend" id="dateend" style="border-radius: 8px; padding: 16px; border: 1px #E1E1E1 solid;">
            </div>
        </div>
        <div class=" modal-footer" style="display: flex; gap: 14px;">
            <div onclick="closeModal()" class="request-stock">Close</div>
            <div id="submit" class="request-stock" style="background-color: #FFC300;">Submit</div>
        </div>
    </div>
</div>
<script src="script.js"></script>
<script>
    $(document).ready(function() {
        $('#submit').click(function(e) {
            e.preventDefault();
            var datestart = $('#datestart').val();
            var dateend = $('#dateend').val();

            // make the date is plus 1
            var nextDay = new Date(dateend);
            nextDay.setDate(nextDay.getDate() + 1);

            var formattedDateEnd = nextDay.toISOString().split('T')[0]; // Format as YYYY-MM-DD
            var url = "index.php?page=transaction&datestart=" + encodeURIComponent(datestart) + "&dateend=" + encodeURIComponent(formattedDateEnd);

            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    window.location.href = url;
                },
            });
        });
    });
</script>
</body>

</html>