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
}
