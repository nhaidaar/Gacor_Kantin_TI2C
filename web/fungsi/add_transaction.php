<?php
session_start();
require '../config/koneksi.php';

$user_id = $_SESSION['id'];
$dataRow = $_POST['dataRow'];

$query = "INSERT INTO transactions (date, user_id)
        VALUES (NOW(), $user_id)";
$result = mysqli_query($koneksi, $query);
$id = mysqli_insert_id($koneksi);

foreach ($dataRow as $row) {
        $product_id = $row['product_id'];
        $qty = $row['qty'];
        $total_price = $row['total_price'];

        $sql = "INSERT INTO 
                        transaction_items
                        (transactions_id, product_id, qty, total_price)
                VALUES
                        ($id, $product_id, $qty, $total_price)";
        $result = mysqli_query($koneksi, $sql);
}
