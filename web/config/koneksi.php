<?php
date_default_timezone_set("Asia/Jakarta");
$koneksi = mysqli_connect("localhost", "root", "", "kantin");


if (mysqli_connect_errno()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
