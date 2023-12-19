<?php
require '../config/koneksi.php';
$id = $_POST['id'];

$query = "UPDATE 
            add_product_log
        SET
            status = 'approved'
        WHERE
            id = $id";
$result = mysqli_query($koneksi, $query);
return $result;
