<?php
class Transaction
{
    private $koneksi;

    function __construct($connection)
    {
        $this->koneksi = $connection;
    }

    function fetchTransaction($id)
    {
        $query = "SELECT 
                    t.id AS order_id, 
                    TIME(t.date) AS order_time, 
                    DATE(t.date) AS order_date, 
                    p.product_name, ti.qty, p.selling_price, ti.total_price
                FROM 
                    transactions t
                INNER JOIN 
                    transaction_items ti ON t.id = ti.transactions_id
                INNER JOIN 
                    product p ON ti.product_id = p.id
                WHERE 
                    t.id = $id";
        $result = mysqli_query($this->koneksi, $query);
        return $result;
    }

    function fetchAllTransaction($limit)
    {
        $query = "SELECT 
                    t.id AS order_id,
                    GROUP_CONCAT(CONCAT(ti.qty, 'pcs ', p.product_name) SEPARATOR '\n') AS product,
                    TIME(t.date) AS transaction_time,
                    DATE(t.date) AS transaction_date,
                    SUM(ti.total_price) AS total_price
                FROM 
                    transactions t
                INNER JOIN 
                    transaction_items ti ON t.id = ti.transactions_id
                INNER JOIN 
                    product p ON ti.product_id = p.id
                GROUP BY 
                    t.id
                ORDER BY 
                    t.date DESC";

        $query .= ($limit == null) ? "" : " LIMIT $limit";

        $result = mysqli_query($this->koneksi, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $this->showTransaction($row);
        }
    }

    function fetchTransactionByDate($datestart, $dateend)
    {
        $query = "SELECT 
                    t.id AS order_id,
                    GROUP_CONCAT(CONCAT(ti.qty, 'pcs ', p.product_name) SEPARATOR '\n') AS product,
                    TIME(t.date) AS transaction_time,
                    DATE(t.date) AS transaction_date,
                    SUM(ti.total_price) AS total_price
                FROM 
                    transactions t
                INNER JOIN 
                    transaction_items ti ON t.id = ti.transactions_id
                INNER JOIN 
                    product p ON ti.product_id = p.id
                WHERE
                    t.date >= '$datestart' AND t.date <= '$dateend'
                GROUP BY 
                    t.id
                ORDER BY t.date DESC
                ";
        $result = mysqli_query($this->koneksi, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $this->showTransaction($row);
            }
        } else {
            echo '<tr>
                    <td>No result found.</td>
                </tr>';
        }
    }

    function showTransaction($row)
    {
        echo '<tr>
        <td> #' . sprintf('%08s', strtoupper(dechex($row['order_id']))) . '</td>
        <td>' . $row['product'] . '</td>
        <td>' . date("d-m-Y", strtotime($row['transaction_date'])) . '</td>
        <td>' . $row['transaction_time'] . '</td>
        <td>IDR ' . number_format($row['total_price'], 2, ',', '.') . '</td>
        <td><a href="index.php?page=transaction/check_details&id=' . $row['order_id'] . '">See Detail</a></td>
        </tr>';
    }
}
