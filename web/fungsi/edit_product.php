<?php
require '../config/koneksi.php';

$id = $_POST['id'];
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

$query = "UPDATE product SET
            product_name = '$name', category_id = $category_id, description = '$description', 
            stocks = $stocks, buying_price = $buying_price, selling_price = $selling_price
            WHERE id = $id";
$result = mysqli_query($koneksi, $query);
header("Location: ../index.php?page=product");
