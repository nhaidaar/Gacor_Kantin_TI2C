<?php
session_start();
require '../config/koneksi.php';
require '../class/product.php';

$product = new Product($koneksi);

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $row = $product->fetchProduct($id);
    echo '<tr>
            <td id="product_id">' . $row['id'] . '</td>
            <td>' . $row['product_name'] . '</td>
            <td>' . $row['stocks'] . '</td>
            <td><input class="seedetail" type="number" name="qty" id="qty" value="1" min="1" max="' . $row['stocks'] . '"></td>
            <td id="selling_price">' . $row['selling_price'] . '</td>
            <td id="eachtotal">' . $row['selling_price'] . '</td>
            <td class = "transaction-detail"><div id="cancel-row" class="request-stock" style="background-color: #EC1A1A; color: #fff; width: max-content;">Cancel</div></td>
        </tr>';
}
