<?php
session_start();
require '../config/koneksi.php';
require '../class/product.php';

$product = new Product($koneksi);

if (isset($_POST['input'])) {
    $input = $_POST['input'];
    $product->searchProductForTransaction($input);
}
