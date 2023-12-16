<?php
session_start();
require '../config/koneksi.php';
require '../class/product.php';

$product = new Product($koneksi);

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $row = $product->fetchProduct($id);
    echo '<tr>
            <td>' . $row['id'] . '</td>
            <td>' . $row['product_name'] . '</td>
            <td>' . $row['stocks'] . '</td>
            <td><input type="number" name="qty" id="qty" value="1" min="1" max="' . $row['stocks'] . '"></td>
            <td>' . $row['selling_price'] . '</td>
            <td id="eachtotal">' . $row['selling_price'] . '</td>
            <td><div id="cancel-row" class="request-stock" style="background-color: #EC1A1A; color: #fff;">Cancel</div></td>
        </tr>';
}
