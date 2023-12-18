<?php 
require '../config/koneksi.php';

$id = $_POST['id'];

$query = "UPDATE product SET isHidden = 1 WHERE id = $id";

$result = mysqli_query($koneksi, $query);
header("Location: ../index.php?page=product");
?>