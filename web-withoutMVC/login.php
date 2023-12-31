<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();

?>
<!DOCTYPE html>
<html>

<head>
    <title>Login - JTI Polinema</title>
    <link rel="shortcut icon" href="assets/logo-jti.png" type="image/x-icon">
    <link rel="stylesheet" href="style-login.css">
</head>

<body>
    <div class="login">
        <div class="title-row">
            <img src="assets/logo-jti.png">
            <div class="title">
                JTI Polinema
            </div>
        </div>
        <div style="height: 32px;"></div>
        <div class="welcome">
            <div class="welcome-title">
                Welcome to JTI Polinema!
            </div>
            <div class="welcome-sub">
                Prepare yourself to enjoy various shows that will accompany your daily life in Kantin JTI!
            </div>
        </div>
        <div style="height: 24px;"></div>
        <form action="cek_login.php" method="post" class="login-form">
            <label for="username">Username</label>
            <input type="text" name="username" placeholder="Enter your name">
            <div style="height: 16px;"></div>
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Enter your password">
            <div style="height: 48px;"></div>
            <button type="submit">Login</button>
        </form>
    </div>
    <div style="width: 20px;"></div>
    <div class="display-image"></div>
</body>

</html>