<!DOCTYPE html>
<html>

<head>
    <title>Kantin Gacor</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="assets/logo-jti.png" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"> -->
</head>

<body>
    <?php
    // Set the active menu sidebar
    if (isset($_GET['page'])) {
        $status = $_GET['page'];
    } else {
        $status = 'dashboard';
    }

    require 'class/notification.php';
    $notif = new Notification($koneksi);
    $count = $notif->countNotification();
    ?>
    <div class="sidebar">
        <a href="index.php">
            <div class="jti">
                <img src="assets/logo-jti.png">
                <div class="title">JTI Polinema</div>
            </div>
        </a>
        <ul>
            <li>
                <a href="index.php?page=dashboard" <?php echo (!empty($status) && str_starts_with($status, 'dashboard'))
                                                        ? 'class="active"'
                                                        : '';
                                                    ?>>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6.458 8.125H4.167A1.667 1.667 0 0 1 2.5 6.458V4.167c0-.921.746-1.667 1.667-1.667h2.291c.921 0 1.667.746 1.667 1.667v2.291c0 .921-.746 1.667-1.667 1.667Zm9.375 0h-2.291a1.667 1.667 0 0 1-1.667-1.667V4.167c0-.921.746-1.667 1.667-1.667h2.291c.921 0 1.667.746 1.667 1.667v2.291c0 .921-.746 1.667-1.667 1.667ZM6.458 17.5H4.167A1.667 1.667 0 0 1 2.5 15.833v-2.291c0-.921.746-1.667 1.667-1.667h2.291c.921 0 1.667.746 1.667 1.667v2.291c0 .921-.746 1.667-1.667 1.667Zm9.375 0h-2.291a1.667 1.667 0 0 1-1.667-1.667v-2.291c0-.921.746-1.667 1.667-1.667h2.291c.921 0 1.667.746 1.667 1.667v2.291c0 .921-.746 1.667-1.667 1.667Z" clip-rule="evenodd" />
                    </svg>
                    Dashboard</a>
            </li>
            <li>
                <a href="index.php?page=product" <?php echo (!empty($status) && str_starts_with($status, 'product'))
                                                        ? 'class="active"'
                                                        : '';
                                                    ?>>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12.501 7.186V7.5a2.501 2.501 0 0 1-2.5 2.501v0A2.501 2.501 0 0 1 7.498 7.5v-.313" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12.501 7.186V7.5a2.501 2.501 0 0 0 2.501 2.5h.207a2.294 2.294 0 0 0 2.294-2.294v0c0-.34-.092-.674-.267-.965l-2-3.333a1.876 1.876 0 0 0-1.609-.911H6.373c-.66 0-1.27.346-1.609.91l-2 3.334a1.876 1.876 0 0 0-.267.965v0A2.294 2.294 0 0 0 4.79 10h.207a2.501 2.501 0 0 0 2.5-2.501v-.313" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16.565 9.554v6.073c0 1.036-.84 1.876-1.876 1.876H5.312a1.876 1.876 0 0 1-1.876-1.876V9.553m7.971 4.485H8.593" />
                    </svg>
                    Product</a>
            </li>
            <li>
                <a href="index.php?page=transaction" <?php echo (!empty($status) && str_starts_with($status, 'transaction'))
                                                            ? 'class="active"'
                                                            : '';
                                                        ?>>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5" d="M18.333 5v2.017c0 1.316-.833 2.15-2.15 2.15h-2.85V3.342c0-.925.759-1.675 1.684-1.675a3.35 3.35 0 0 1 2.341.975c.6.608.975 1.441.975 2.358Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5" d="M1.667 5.833V17.5A.83.83 0 0 0 3 18.167L4.425 17.1a.84.84 0 0 1 1.1.083l1.383 1.392a.84.84 0 0 0 1.184 0l1.4-1.4a.826.826 0 0 1 1.083-.075L12 18.167a.835.835 0 0 0 1.333-.667V3.333c0-.916.75-1.666 1.667-1.666H5C2.5 1.667 1.667 3.158 1.667 5v.833Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7.5 10.842H10M7.5 7.508H10" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.996 10.833h.008M4.996 7.5h.008" />
                    </svg>
                    Transaction</a>
            </li>
            <li>
                <a href="index.php?page=notification" <?php echo (!empty($status) && str_starts_with($status, 'notification'))
                                                            ? 'class="active"'
                                                            : '';
                                                        ?>>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                        <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.995 10.833V7.5c0-2.762 2.24-5 5.005-5a5.002 5.002 0 0 1 5.005 5v3.333c0 .822.373 1.6 1.014 2.114l.258.207c.764.614.33 1.846-.65 1.846H4.373c-.98 0-1.414-1.232-.65-1.846l.258-.207a2.71 2.71 0 0 0 1.014-2.114Z" clip-rule="evenodd" />
                        <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.75 17.5h2.5" />
                    </svg>
                    Notification
                    <?php
                    if ($count > 0) {
                    ?>
                        <div class="notif"><?= $count ?></div>
                    <?php
                    }
                    ?>
                </a>
            </li>
        </ul>
        <div class="logout">
            <a href="logout.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                    <path stroke="#EC1A1A" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.167 16.16V6.252c0-.575-.296-1.109-.784-1.413L5.05 2.756C3.94 2.062 2.5 2.86 2.5 4.169v9.907c0 .575.296 1.109.783 1.413l3.334 2.084c1.11.694 2.55-.105 2.55-1.413Z" clip-rule="evenodd" />
                    <path stroke="#EC1A1A" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12.5 9.167h5m-1.667 1.666L17.5 9.167 15.833 7.5m-6.666 8.333H12.5c.92 0 1.667-.745 1.667-1.666v-.834m0-8.333v-.833c0-.921-.746-1.667-1.667-1.667H4.167" />
                </svg>
                Log Out</a>
        </div>
    </div>