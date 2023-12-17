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
                    * 
                from 
                    add_stock_log 
                WHERE 
                    id = $id";
        $result = mysqli_query($this->koneksi, $query);
        return $result;
    }

    function showNotification()
    {
        $query = "SELECT 
                    * 
                from 
                    add_product_log 
                ORDER BY 
                    date DESC";
        $result = mysqli_query($this->koneksi, $query);
        if ($_SESSION['level'] == 'admin') {
            while ($row = mysqli_fetch_assoc($result)) {
                $this->adminNotif($row);
            }
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                $this->userNotif($row);
            }
        }
    }

    function adminNotif($row)
    {
        echo '<div class="notif-box">
                    <div class="message-box">
                        <div class="message">' . ($row['status'] == 'pending' ?
            '<span class="user-name">Naufal Haidar</span> request <span class="user-name">' . $row['product_name'] . '</span> as new product'
            : 'You have ' . $row['status'] . ' request of <span class="user-name">' . $row['product_name']) .
            '</span></div>
                        <div class="message-date">' . date('D, d F Y', strtotime($row['date'])) . '</div>
                    </div>'
            . ($row['status'] == 'pending' ? '<a href="index.php?page=notification/view_product&id=' . $row['id'] . '" class="view-button">View</a>' : ' ') .
            '</div>';
    }

    function userNotif($row)
    {
        echo '<div class="notif-box">
                    <div class="message-box">
                        <div class="message user-name">Your request of <span class="user-name">' . $row['product_name'] . '</span> ' . ($row['status'] == 'pending' ? 'is pending' : ($row['status'] == 'approved' ? 'has been approved' : 'has been rejected')) . '</div>
                        <div class="message-date">' . date('D, d F Y', strtotime($row['date'])) . '</div>
                    </div>
                </div>';
    }
}
