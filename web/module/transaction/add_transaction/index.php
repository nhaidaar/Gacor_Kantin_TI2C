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
            <div onclick="history.back()" class="back-button" style="cursor:pointer; border-radius: 64px; padding: 10.5px 16px; border: 1px #EBEBEB solid; display: flex; align-items: center; gap: 8px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                    <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.167 10h11.666m-7.5-4.167L4.167 10m4.166 4.167L4.167 10" />
                </svg>
                Back
            </div>
        </div>
        <div style="height: 32px;"></div>
        <div style="border: 1px #EBEBEB solid; border-radius: 16px;">
            <div class="modal-header">
                <div class="searchbar" style="width: 100%;">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="9.21552" cy="9.21552" r="5.88495" stroke="#1B1B1B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M16.6695 16.6695L13.3765 13.3765" stroke="#1B1B1B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <input type="text" name="search" class="searchbox" placeholder="Search">
                </div>
            </div>
            <div class="modal-content">
                <table class="tx-detail">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>No results found.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer" style="display: flex; flex-direction: column; gap: 12px;">
                <div class="product-row">
                    <div class="order-attribute">
                        Order ID
                    </div>
                    #00000001
                </div>
                <div class="product-row">
                    <div class="order-attribute">
                        Time
                    </div>
                    #00000001
                </div>
            </div>
            <div class="modal-footer">
                <div class="request-stock" style="background-color:#FFC300;">
                    Submit
                </div>
            </div>
        </div>

    </div>
</div>
</div>
</body>

</html>