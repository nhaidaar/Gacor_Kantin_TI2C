<?php
require '../config/koneksi.php';

$name = $_POST['name'];
$category_id = $_POST['category_id'];
$description = $_POST['desc'];
$stocks = $_POST['stock'];
$buying_price = $_POST['bprice'];
$selling_price = $_POST['sprice'];

$image = $_FILES['image']['name'];
$image_tmp = $_FILES['image']['tmp_name'];
$target_dir = "../assets/";

$target_file = $target_dir . $name . ".png";
move_uploaded_file($image_tmp, $target_file);

$query = "INSERT INTO 
            product 
            (product_name, category_id, description, stocks, buying_price, selling_price)
        VALUES 
            ('$name', $category_id, '$description', $stocks, $buying_price, $selling_price)";

$result = mysqli_query($koneksi, $query);
header("Location: ../index.php?page=product");
