<?php
class TransactionModel
{

    private $db;

    function __construct()
    {
        $this->db = new Database;
    }

    function createTransaction($user_id, $dataRow)
    {
        $this->db->query("INSERT INTO 
                            transactions 
                            (date, user_id)
                        VALUES 
                            (NOW(), $user_id)
                        ");
        $this->db->execute();

        $id = $this->db->insertId();

        foreach ($dataRow as $row) {
            $product_id = $row['product_id'];
            $qty = $row['qty'];
            $total_price = $row['total_price'];

            $this->db->query("INSERT INTO 
                                transaction_items
                                (transactions_id, product_id, qty, total_price)
                            VALUES
                                ($id, $product_id, $qty, $total_price)");
            $this->db->execute();
        }
    }

    function fetchTransaction($id)
    {
        $this->db->query("SELECT 
                            t.id AS order_id, 
                            TIME(t.date) AS order_time, 
                            DATE(t.date) AS order_date,
                            COUNT(*) AS item_count,
                            SUM(ti.total_price) AS total_price
                        FROM 
                            transactions t
                        INNER JOIN 
                            transaction_items ti ON t.id = ti.transactions_id
                        INNER JOIN 
                            product p ON ti.product_id = p.id
                        WHERE 
                            t.id = $id;
                        ");
        return $this->db->fetch();
    }

    function fetchTransactionItems($id)
    {
        $this->db->query("SELECT 
                            p.product_name, ti.qty, p.selling_price, ti.total_price
                        FROM 
                            transactions t
                        INNER JOIN 
                            transaction_items ti ON t.id = ti.transactions_id
                        INNER JOIN 
                            product p ON ti.product_id = p.id
                        WHERE 
                            t.id = $id
                        ");
        return $this->db->fetchAll();
    }


    function getFilteredTransaction($start, $end)
    {

        $this->db->query("SELECT 
                            t.id AS order_id,
                            TIME(t.date) AS transaction_time,
                            DATE(t.date) AS transaction_date,
                            SUM(ti.total_price) AS total_price
                        FROM 
                            transactions t
                        INNER JOIN 
                            transaction_items ti ON t.id = ti.transactions_id
                        WHERE
                            t.date BETWEEN '$start 00:00:00' AND '$end 23:59:59'
                        GROUP BY 
                            t.id
                        ORDER BY 
                            t.date DESC
                        ");
        return $this->db->fetchAll();
    }

    function getAllTransaction()
    {

        $this->db->query("SELECT 
                            t.id AS order_id,
                            TIME(t.date) AS transaction_time,
                            DATE(t.date) AS transaction_date,
                            SUM(ti.total_price) AS total_price
                        FROM 
                            transactions t
                        INNER JOIN 
                            transaction_items ti ON t.id = ti.transactions_id
                        GROUP BY 
                            t.id
                        ORDER BY 
                            t.date DESC
                        ");
        return $this->db->fetchAll();
    }

    function getRecentTransaction($limit)
    {

        $this->db->query("SELECT 
                            t.id AS order_id,
                            TIME(t.date) AS transaction_time,
                            DATE(t.date) AS transaction_date,
                            SUM(ti.total_price) AS total_price
                        FROM 
                            transactions t
                        INNER JOIN 
                            transaction_items ti ON t.id = ti.transactions_id
                        GROUP BY 
                            t.id
                        ORDER BY 
                            t.date DESC
                        LIMIT
                            $limit
                        ");
        return $this->db->fetchAll();
    }

    function searchProduct($search)
    {
        $this->db->query("SELECT
                            p.id, p.product_name, p.stocks,
                            p.buying_price, p.selling_price, c.category_name
                        FROM 
                            product AS p
                        INNER JOIN 
                            category AS c ON p.category_id = c.id
                        WHERE 
                            p.product_name LIKE '%$search%'
                        AND
                            p.isHidden = 0
                        ");
        return $this->db->fetchAll();
    }
}
