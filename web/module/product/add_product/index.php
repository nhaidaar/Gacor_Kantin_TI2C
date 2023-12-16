<div class="content">
    <div class="header-fixed">
        <div class="htitle">
            <?= $_SESSION['level'] == 'admin' ? 'Add Product' : 'Request Product' ?>
        </div>
    </div>
    <div class="header">
        <div class="htitle">
            <?= $_SESSION['level'] == 'admin' ? 'Add Product' : 'Request Product' ?>
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
            <div class="modal-header2">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="none">
                    <rect width="39" height="39" x=".5" y=".5" fill="#F4F4F4" rx="19.5" />
                    <rect width="39" height="39" x=".5" y=".5" stroke="#EBEBEB" rx="19.5" />
                    <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m14.41 23.016 8.606-8.605a.833.833 0 0 1 1.177 0l1.397 1.396a.833.833 0 0 1 0 1.178l-8.606 8.604a.83.83 0 0 1-.588.244h-2.23v-2.229a.83.83 0 0 1 .245-.588Z" clip-rule="evenodd" />
                    <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m21.458 15.967 2.575 2.575" />
                </svg>
                <div style="display: flex; flex-direction: column; gap: 4px;">
                    <div class="modal-header-title" style="font-weight: 500; font-size: 16px;">
                        <?= $_SESSION['level'] == 'admin' ? 'Add Product' : 'Request Product' ?>
                    </div>
                    <div class="modal-header-sub" style="font-weight: 400; color: #7B7B7B; font-size: 14px;">
                        Select and upload the files of your choice
                    </div>
                </div>
            </div>
            <form action="fungsi/<?= $_SESSION['level'] == 'admin' ? 'upload_product.php' : 'request_product.php' ?>" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div style="display: flex; flex-direction: column; gap: 24px;">
                        <label for="input-file" id="drop-area">
                            <img id="preview-image" style="width: 400px; height: 300px; display: none; object-fit:contain;">
                            <div class="input-desc">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none">
                                    <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m15 15-3-3m0 0-3 3m3 5v-8m-4 7H6a4 4 0 0 1 0-8l-.01-.07a6.071 6.071 0 1 1 12.02 0L18 11a4 4 0 0 1 0 8h-2" />
                                </svg>
                                <div style="display: flex; flex-direction:column; gap: 8px;">
                                    <div class="modal-header-title" style="font-weight: 500; font-size: 16px;">
                                        Choose a image or drag & drop it here.
                                    </div>
                                    <div class="modal-header-sub" style="font-weight: 400; color: #7B7B7B; font-size: 14px;">
                                        JPEG or PNG up to 10 MB.
                                    </div>
                                </div>
                            </div>
                            <div class="request-stock" style="width: max-content;">Browse Image</div>
                            <input type="file" accept="image/*" name="image" id="input-file" required hidden>
                        </label>
                        <div class="myform">
                            <label for="name">Product Name<span style="color: #EC1A1A;">*</span></label>
                            <input type="text" name="name" id="name" style="border-radius: 8px; padding: 16px; border: 1px #E1E1E1 solid; outline: none" placeholder="Name of product" required>
                        </div>
                        <div class="myform">
                            <label>Category<span style="color: #EC1A1A;">*</span></label>
                            <div id="product-category" class="product-category" style="display: flex; align-items: center; justify-content: center; width: 100%; gap: 8px;">
                                <?php
                                require 'class/category.php';
                                $category = new Category($koneksi);
                                $result = $category->fetchCategory();
                                $category->showAllCategoryRadio($result);
                                ?>
                            </div>
                        </div>
                        <div class="myform">
                            <label for="desc">Description</label>
                            <input type="text" name="desc" id="desc" style="border-radius: 8px; padding: 16px; border: 1px #E1E1E1 solid; " placeholder="Ex. “Isi ayam suwir”">
                        </div>
                        <div class="myform">
                            <label for="stock">Stock(s)<span style="color: #EC1A1A;">*</span></label>
                            <input type="number" name="stock" id="stock" style="border-radius: 8px; padding: 16px; border: 1px #E1E1E1 solid; " placeholder="0" required>
                        </div>
                        <div class="myform">
                            <label for="bprice">Buying Price<span style="color: #EC1A1A;">*</span></label>
                            <div class="input-box">
                                IDR
                                <input type="number" name="bprice" id="bprice" style="width: 100%; border: none; outline: none;" placeholder="000" required>
                            </div>
                        </div>
                        <div class="myform">
                            <label for="sprice">Selling Price<span style="color: #EC1A1A;">*</span></label>
                            <div class="input-box">
                                IDR
                                <input type="number" name="sprice" id="sprice" style="width: 100%; border: none; outline: none;" placeholder="000" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="display: flex; gap: 16px;">
                    <div onclick="history.back()" class="request-stock" style="padding: 16px;">Cancel</div>
                    <button id="add-product" type="submit" id="submitBtn" class="request-stock" style="padding: 16px; background-color: #FFC300;"><?= $_SESSION['level'] == 'admin' ? 'Add Product' : 'Request Product' ?></button>
                </div>
            </form>
        </div>

    </div>
</div>
</div>

<script>
    const dropArea = document.getElementById('drop-area');
    const inputFile = document.getElementById('input-file');
    const previewImage = document.getElementById('preview-image');
    const inputDesc = document.querySelector('.input-desc');

    inputFile.addEventListener('change', uploadImage);

    function uploadImage() {
        let imgLink = URL.createObjectURL(inputFile.files[0]);
        previewImage.src = imgLink;
        previewImage.style.display = 'block';
        inputDesc.style.display = 'none';
    }
    dropArea.addEventListener('dragover', function(e) {
        e.preventDefault();
    });
    dropArea.addEventListener('drop', function(e) {
        e.preventDefault();
        inputFile.files = e.dataTransfer.files;
        uploadImage();
    });
</script>
</body>

</html>