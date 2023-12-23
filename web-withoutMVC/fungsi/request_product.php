<?php
require '../config/koneksi.php';
session_start();

$user_id = $_SESSION['id'];
$name = $_POST['name'];
$category_id = $_POST['category_id'];
$description = $_POST['desc'];
$stocks = $_POST['stock'];
$buying_price = $_POST['bprice'];
$selling_price = $_POST['sprice'];

// if (!empty($_FILES['image']['name'])) {
$image = $_FILES['image']['name'];
$image_tmp = $_FILES['image']['tmp_name'];
$target_dir = "../assets/";

$target_file = $target_dir . $name . ".png";
move_uploaded_file($image_tmp, $target_file);
// }

$query = "INSERT INTO 
            add_product_log 
            (user_id, product_name, date, category_id, description, stocks, buying_price, selling_price)
        VALUES 
            ($user_id, '$name', NOW(), $category_id, '$description', $stocks, $buying_price, $selling_price)";
$result = mysqli_query($koneksi, $query);
header("Location: ../index.php?page=notification");
