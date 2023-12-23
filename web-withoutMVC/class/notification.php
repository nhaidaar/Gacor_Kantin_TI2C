<?php
class Notification
{
    private $koneksi;

    function __construct($connection)
    {
        $this->koneksi = $connection;
    }

    function countNotification()
    {
        $query = "SELECT
                    (
                        SELECT COUNT(id)
                        FROM add_product_log
                        WHERE status = 'pending'
                    ) as notif_product,
                    (
                        SELECT COUNT(id)
                        FROM add_stock_log
                        WHERE status = 'pending'
                    ) as notif_stock;
                ";
        $result = mysqli_query($this->koneksi, $query);
        $row = mysqli_fetch_assoc($result);
        $count = $row['notif_product'] + $row['notif_stock'];
        return $count;
    }

    function fetchProductNotification($id)
    {
        $query = "SELECT 
                    * 
                from 
                    add_product_log 
                WHERE 
                    id = $id";
        $result = mysqli_query($this->koneksi, $query);
        return $result;
    }

    function fetchStockNotification($id)
    {
        $query = "SELECT 
                    s.id, p.product_name, s.stocks
                from 
                    add_stock_log AS s
                INNER JOIN
                    product AS p ON p.id = s.product_id
                WHERE 
                    s.id = $id";
        $result = mysqli_query($this->koneksi, $query);
        return $result;
    }

    function getAllProductNotification()
    {
        $query = "SELECT 
                    p.id, p.status, p.product_name, p.date, u.name
                from 
                    add_product_log AS p
                INNER JOIN
                    user AS u ON u.id = p.user_id 
                ORDER BY 
                    date DESC";
        $result = mysqli_query($this->koneksi, $query);
        return $result;
    }

    function getAllStockNotification()
    {
        $query = "SELECT 
                    s.id, p.product_name, s.date, s.stocks, s.status, u.name
                from 
                    add_stock_log AS s
                INNER JOIN
                    user AS u ON u.id = s.user_id 
                INNER JOIN
                    product AS p ON p.id = s.product_id
                ORDER BY 
                    date DESC";
        $result = mysqli_query($this->koneksi, $query);
        return $result;
    }

    function showNotification()
    {
        $productResult = $this->getAllProductNotification();
        $stockResult = $this->getAllStockNotification();

        $notif = [];
        while ($row = mysqli_fetch_assoc($productResult)) {
            $row['type'] = 'product';
            $notif[] = $row;
        }
        while ($row = mysqli_fetch_assoc($stockResult)) {
            $row['type'] = 'stock';
            $notif[] = $row;
        }

        usort($notif, function ($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });

        foreach ($notif as $n) {
            $this->notificationView($n);
        }
    }

    function notificationView($row)
    {
        echo '<div class="notif-box">
                <div class="message-box">
                    <div class="message">';
        if ($row['status'] == 'pending') {
            if ($row['type'] == 'product') {
                if ($_SESSION['level'] == 'admin') {
                    echo '<span class="dot"></span><span class="user-name">' . $row['name'] . '</span> request <span class="user-name"> New Product - ' . $row['product_name'] . '</span>';
                } else {
                    echo '<span class="dot"></span>Your request of <span class="user-name"> New Product - ' . $row['product_name'] . '</span> is pending';
                }
            } else {
                if ($_SESSION['level'] == 'admin') {
                    echo '<span class="dot"></span><span class="user-name">' . $row['name'] . '</span> request <span class="user-name">' . $row['stocks'] . ' Stock(s) - ' . $row['product_name'] . '</span>';
                } else {
                    echo '<span class="dot"></span>Your request of <span class="user-name">' . $row['stocks'] . ' Stock(s) - ' . $row['product_name'] . '</span> is pending';
                }
            }
        } else {
            if ($row['type'] == 'product') {
                if ($_SESSION['level'] == 'admin') {
                    echo 'You have ' . $row['status'] . ' <span class="user-name"> New Product - ' . $row['product_name'] . '</span>';
                } else {
                    echo 'Your request of <span class="user-name">New Product - ' . $row['product_name'] . '</span> has been ' . $row['status'];
                }
            } else {
                if ($_SESSION['level'] == 'admin') {
                    echo 'You have ' . $row['status'] . ' <span class="user-name">' . $row['stocks'] . ' Stock(s) - ' . $row['product_name'] . '</span>';
                } else {
                    echo 'Your request of <span class="user-name">' . $row['stocks'] . ' Stock(s) - ' . $row['product_name'] . '</span> has been ' . $row['status'];
                }
            }
        }
        echo '</div>
            <div class="message-date">' . date('D, d F Y', strtotime($row['date'])) . '</div>
        </div>';

        if ($row['status'] == 'pending') {
            if ($row['type'] == 'product') {
                if ($_SESSION['level'] == 'admin') {
                    echo '<a href="index.php?page=notification/view_product&id=' . $row['id'] . '" class="view-button">View</a>';
                }
            } else {
                if ($_SESSION['level'] == 'admin') {
                    echo '<a href="index.php?page=notification/view_stock&id=' . $row['id'] . '" class="view-button">View</a>';
                }
            }
        }
        echo '</div>';
    }
}
