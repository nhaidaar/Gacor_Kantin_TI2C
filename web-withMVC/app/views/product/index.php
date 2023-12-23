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
                <a href="<?= BASEURL . 'product/add' ?>">
                    <div class="edit-product-yellow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                            <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 10h10m-5 5V5" />
                        </svg>
                        <?= ($_SESSION['level'] == 'admin' ? 'Add Product' : 'Request Product') ?>
                    </div>
                </a>
            </div>
        </div>
        <div style="height: 32px;"></div>
        <div class="product-wrap">
            <?php
            $data_product = $data['product'];
            foreach ($data_product as $product) : ?>
                <div class="product-container">
                    <div class="product-preview">
                        <div class="product-stock" <?= $product['stocks'] < 10 ? 'style="color: #EC1A1A;"' : '' ?>>
                            <?= $product['stocks'] ?> Stock(s)
                        </div>
                        <img src="<?= BASEURL . 'assets/products/' . $product['product_name'] ?>.png" class="product-img<?= $product['stocks'] == 0 ? '-grayscale' : '' ?>">
                    </div>
                    <div class="product-detail">
                        <div class="product-name"><?= $product['product_name'] ?></div>
                        <div class="product-category"><?= $product['category_name'] ?></div>
                        <div class="product-price">
                            IDR <?= number_format($product['selling_price'], 2, ',', '.') ?></div>
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
    </div>
    <script>
        $(document).ready(function() {
            $('.searchbox').keyup(function(e) {
                // GET THE INPUT AND ALL PRODUCT
                var input = $(this).val();
                var items = document.querySelectorAll('.product-container');

                // MENGECEK TIAP PRODUK, APAKAH NAMA PRODUK MIRIP DENGAN INPUTAN SEARCH
                items.forEach(item => {
                    const itemName = item.querySelector('.product-name').innerText.toLowerCase();

                    if (itemName.includes(input)) {
                        item.style.display = 'block'; // Show the product
                    } else {
                        item.style.display = 'none'; // Hide the product
                    }
                })
            });
        });
    </script>
    </body>

    </html>