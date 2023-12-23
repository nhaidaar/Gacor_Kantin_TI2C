<?php
session_start();
require '../config/koneksi.php';

$id = $_POST['id'];
$stocks = $_POST['stock'];
$user_id = $_SESSION['id'];

$query = "INSERT INTO 
            add_stock_log 
            (product_id, date, stocks, user_id)
        VALUES 
            ($id, NOW(), $stocks, $user_id)";
$result = mysqli_query($koneksi, $query);

header("Location: ../index.php?page=notification");
