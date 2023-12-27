<div class="content">
    <div class="header-fixed">
        <div class="htitle">
            Add Transaction
        </div>
    </div>
    <div class="header">
        <div class="htitle">
            Add Transaction
        </div>
    </div>
    <div class="container">
        <div class="product-row">
            <div onclick="history.back()" class="back-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                    <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.167 10h11.666m-7.5-4.167L4.167 10m4.166 4.167L4.167 10" />
                </svg>
                Back
            </div>
        </div>
        <div style="height: 32px;"></div>
        <div style="border: 1px #EBEBEB solid; border-radius: 16px;">
            <div class="modal-header" style="display: flex; flex-direction: column; gap: 8px;">
                <div class="searchbar" style="width: 100%;">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="9.21552" cy="9.21552" r="5.88495" stroke="#1B1B1B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M16.6695 16.6695L13.3765 13.3765" stroke="#1B1B1B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <input type="search" name="search" class="searchbox" placeholder="Search">
                </div>
                <div class="search-result" style="display: none;">

                </div>
            </div>
            <div class="modal-content">
                <table id="cart" class="transaction tx-detail">
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Product</th>
                            <th>Recent Stock(s)</th>
                            <th>Quantity</th>
                            <th>@</th>
                            <th>Total Price</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="order-list">
                        <tr>
                            <td>No results found.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer" style="display: flex; flex-direction: column; gap: 12px;">
                <div class="product-row">
                    <div class="order-attribute">
                        Total Price
                    </div>
                    <div>
                        IDR <span id="total_price">0</span>
                    </div>
                </div>
                <div class="product-row">
                    <div class="order-attribute">
                        Change
                    </div>
                    <div>
                        IDR <span id="change">0</span>
                    </div>
                </div>
                <div></div>
                <div class="myform">
                    <label for="pay">Pay</label>
                    <div class="input-box">
                        IDR
                        <input type="number" name="pay" id="pay" style="width: 100%; border: none; outline: none;" placeholder="000">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div id="submit" class="request-stock" style="background-color:#FFC300; padding: 16px;">
                    Place Order
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        // Fungsi untuk mengupdate Total Price setiap dipanggil
        function updateTotalPrice() {
            var totalPrice = 0;

            // Menjumlahkan total price tiap row (product)
            $('#order-list td#eachtotal').each(function() {
                totalPrice += parseFloat($(this).text());
            });

            // Mengupdate total price keseluruhan
            $('#total_price').text(totalPrice);
        }

        // Searching Product
        $('.searchbox').keyup(function(e) {
            var input = $(this).val();
            const box = document.querySelector('.search-result');
            if (input != '') {
                box.style.display = 'block';
                $.ajax({
                    url: '<?= BASEURL . 'transaction/searchProduct' ?>',
                    type: "POST",
                    data: {
                        input: input
                    },
                    success: function(response) {
                        $('.search-result').html(response);
                    }
                });
            } else {
                box.style.display = 'none';
            }
        });

        // Pilih product yang telah disearch untuk masuk ke cart
        $(document).on('click', '.search-result-container', function() {
            var id = $(this).data('id');

            // Mengecek apakah produk sudah ada di cart
            var productExists = false;
            $('#order-list tr').each(function() {
                var product_id = $(this).find('#product_id').text();

                // Jika produk telah ada, maka tambahkan quantity nya
                if (product_id.trim() === id.toString()) {
                    productExists = true;
                    var qty = $(this).find('#qty');
                    var newQty = parseInt(qty.val()) + 1;
                    qty.val(newQty);
                    return false;
                }
            });

            // Jika tidak ada maka tambahan ke cart
            if (!productExists) {
                const box = document.querySelector('.search-result');
                box.style.display = 'none';
                $.ajax({
                    type: "POST",
                    url: '<?= BASEURL . 'transaction/addToCart' ?>',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        var noResults = $('#order-list').find('tr:has(td):contains("No results found.")');
                        if (noResults.length) {
                            noResults.replaceWith(response);
                        } else {
                            $('#order-list').append(response);
                        }
                        updateTotalPrice();
                    }
                });
            }
        });

        // Mendeteksi perubahan pada quantity, lalu mengupdate total price
        $(document).on('input change', '#qty', function() {
            var qty = $(this).val();
            var sellingPrice = parseFloat($(this).closest('tr').find('td:eq(4)').text());
            var totalPrice = qty * sellingPrice;
            $(this).closest('tr').find('#eachtotal').text(totalPrice);
            updateTotalPrice();
        });

        // Remove button untuk membatalkan product yang telah dipilih
        $(document).on('click', '#cancel-row', function() {
            $(this).closest('tr').remove();
            updateTotalPrice();
        });

        // Submit transaksi
        $('#submit').on('click', function() {
            var dataRow = [];
            $('#order-list tr').each(function() {
                var data = {
                    'product_id': $(this).find('#product_id').text(),
                    'qty': $(this).find('#qty').val(),
                    'total_price': $(this).find('#eachtotal').text()
                };
                dataRow.push(data);
            });
            $.ajax({
                type: "POST",
                url: "<?= BASEURL . 'transaction/add_send' ?>",
                data: {
                    dataRow: dataRow
                },
                success: function(response) {
                    window.location.href = '<?= BASEURL . 'transaction' ?>';
                }
            });
        });
    });

    // Menghitung total bayar dengan kembalian
    const total_price = document.getElementById('total_price');
    const pay = document.getElementById('pay');
    const change = document.getElementById('change');
    pay.addEventListener('input', function() {
        const totalPriceValue = parseFloat(total_price.innerText);
        const payValue = parseFloat(pay.value) || 0;
        const calculatedChange = (payValue - totalPriceValue).toFixed(2);
        change.innerText = calculatedChange;
    });
</script>
</body>

</html>