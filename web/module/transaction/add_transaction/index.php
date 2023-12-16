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
                <table class="transaction tx-detail">
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
                        <!-- <tr>
                            <td>No results found.</td>
                        </tr> -->
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
                <div class="request-stock" style="background-color:#FFC300; padding: 16px;">
                    Place Order
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        function updateTotalPrice() {
            var totalPrice = 0;

            // Iterate through each 'eachtotal' td element and sum up their values
            $('#order-list td#eachtotal').each(function() {
                totalPrice += parseFloat($(this).text());
            });

            // Update the total price in the #total_price element
            $('#total_price').text(totalPrice);
        }

        $('.searchbox').keyup(function(e) {
            var input = $(this).val();

            const box = document.querySelector('.search-result');
            if (input != '') {
                box.style.display = 'block';
                $.ajax({
                    url: "fungsi/search_transaction.php",
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
        $(document).on('click', '.search-result-container', function() {
            var id = $(this).data('id');
            const box = document.querySelector('.search-result');
            box.style.display = 'none';
            $.ajax({
                type: "POST",
                url: "fungsi/get_product_detail.php",
                data: {
                    id: id
                },
                success: function(response) {
                    $('#order-list').append(response);
                    updateTotalPrice();
                }
            });
        });

        // qty * sellingprice = totalprice
        $(document).on('input change', '#qty', function() {
            var qty = $(this).val();
            var sellingPrice = parseFloat($(this).closest('tr').find('td:eq(4)').text());
            var totalPrice = qty * sellingPrice;
            $(this).closest('tr').find('td:eq(5)').text(totalPrice);
            updateTotalPrice();
        });

        // remove button
        $(document).on('click', '#cancel-row', function() {
            $(this).closest('tr').remove();
            updateTotalPrice();
        });
    });

    // Get references to the elements
    const total_price = document.getElementById('total_price');
    const pay = document.getElementById('pay');
    const change = document.getElementById('change');

    // Add event listener for input on the pay field
    pay.addEventListener('input', function() {
        // Get the values and parse them as numbers
        const totalPriceValue = parseFloat(total_price.innerText);
        const payValue = parseFloat(pay.value) || 0;

        // Calculate the change
        const calculatedChange = (payValue - totalPriceValue).toFixed(2);

        // Display the change in the #change span
        change.innerText = calculatedChange;
    });
</script>
</body>

</html>