<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();

include "config/koneksi.php";
include "fungsi/anti_injection.php";

$username = antiinjection($koneksi, $_POST['username']);
$password = antiinjection($koneksi, $_POST['password']);

$query = "SELECT * FROM user WHERE username = '$username'";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);
mysqli_close($koneksi);

$checked_password = $row['password'];

if ($checked_password == $password) {
    $_SESSION['username'] = $row['username'];
    $_SESSION['level'] = $row['level'];
    header("Location: index.php");
} else {
    header("Location: login.php");
}
