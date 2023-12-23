<?php
class NotificationModel
{
    private $db;

    function __construct()
    {
        $this->db = new Database;
    }

    public function fetchPending()
    {
        $this->db->query("SELECT
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
                        ");
        return $this->db->fetch();
    }

    public function countPending()
    {
        $row = $this->fetchPending();
        return $row['notif_product'] + $row['notif_stock'];
    }

    function fetchAllProductNotification()
    {
        $this->db->query("SELECT 
                            p.id, p.status, p.product_name, p.date, u.name
                        from 
                            add_product_log AS p
                        INNER JOIN
                            user AS u ON u.id = p.user_id 
                        ORDER BY 
                            date DESC
                        ");
        return $this->db->fetchAll();
    }

    function fetchAllStockNotification()
    {
        $this->db->query("SELECT 
                            s.id, p.product_name, s.date, s.stocks, s.status, u.name
                        from 
                            add_stock_log AS s
                        INNER JOIN
                            user AS u ON u.id = s.user_id 
                        INNER JOIN
                            product AS p ON p.id = s.product_id
                        ORDER BY 
                            date DESC
                        ");
        return $this->db->fetchAll();
    }

    function getNotification()
    {
        $productResult = $this->fetchAllProductNotification();
        $stockResult = $this->fetchAllStockNotification();

        $notif = [];
        foreach ($productResult as $product) {
            $product['type'] = 'product';
            $notif[] = $product;
        }

        foreach ($stockResult as $stock) {
            $stock['type'] = 'stock';
            $notif[] = $stock;
        }

        usort($notif, function ($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });

        return $notif;
    }

    function fetchProduct($id)
    {
        $this->db->query("SELECT 
                            * 
                        from 
                            add_product_log 
                        WHERE 
                            id = $id");
        return $this->db->fetch();
    }

    function fetchStock($id)
    {
        $this->db->query("SELECT 
                            s.id, p.product_name, s.stocks
                        from 
                            add_stock_log AS s
                        INNER JOIN
                            product AS p ON p.id = s.product_id
                        WHERE 
                            s.id = $id");
        return $this->db->fetch();
    }
}
