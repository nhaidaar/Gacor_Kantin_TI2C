<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();

if (!empty($_SESSION['level'])) {
    require 'config/koneksi.php';
    // require 'class/product.php';

    include 'template/header.php';
    if (!empty($_GET['page'])) {
        include 'module/' . $_GET['page'] . '/index.php';
    } else {
        include 'module/dashboard/index.php';
    }
} else {
    header("Location: login.php");
}
