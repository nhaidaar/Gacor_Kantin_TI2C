<?php
require '../config/koneksi.php';
$id = $_POST['id'];

$query = "UPDATE 
            add_stock_log
        SET
            status = 'rejected'
        WHERE
            id = $id";
$result = mysqli_query($koneksi, $query);
return $result;
