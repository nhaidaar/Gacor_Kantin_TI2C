<div class="content">
    <div class="header-fixed">
        <div class="htitle">
            Product
        </div>
    </div>
    <div class="header">
        <div class="htitle">
            Product
        </div>
    </div>
    <div class="container">
        <div class="product-row">
            <div class="searchbar">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="9.21552" cy="9.21552" r="5.88495" stroke="#1B1B1B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M16.6695 16.6695L13.3765 13.3765" stroke="#1B1B1B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <input type="text" name="search" class="searchbox" placeholder="Search">
            </div>
            <div style="gap: 8px; display: flex;">
                <div class="edit-product">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                        <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m8.333 6.667-2.5-2.5-2.5 2.5m2.5 9.166V4.167m5.833 9.166 2.5 2.5 2.5-2.5m-2.499-9.166v11.666" />
                    </svg>
                    Sort by
                </div>
                <?php
                if ($_SESSION['level'] == 'admin') {
                ?>
                    <a href="index.php?page=product/add_product">
                        <div class="edit-product-yellow">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                                <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 10h10m-5 5V5" />
                            </svg>
                            Add Product
                        </div>
                    </a>
                <?php } else { ?>
                    <a href="index.php?page=product/add_product">
                        <div class="edit-product-yellow">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                                <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 10h10m-5 5V5" />
                            </svg>
                            Request Product
                        </div>
                    </a>
                <?php } ?>
            </div>
        </div>
        <div style="height: 32px;"></div>
        <div class="product-wrap">
            <?php
            require 'class/product.php';
            $product = new Product($koneksi);
            $product->showAllProduct();
            ?>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.searchbox').keyup(function(e) {
                var input = $(this).val();
                $.ajax({
                    url: "fungsi/search_product.php",
                    type: "POST",
                    data: {
                        input: input
                    },
                    success: function(response) {
                        $('.product-wrap').html(response);
                    }
                });
            });
        });
    </script>
    </body>

    </html>