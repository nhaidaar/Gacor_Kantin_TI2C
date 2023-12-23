<?php
class ProductModel
{
    private $db;

    function __construct()
    {
        $this->db = new Database;
    }

    function getCategory()
    {
        $this->db->query("SELECT category_name FROM category");
        return $this->db->fetchAll();
    }

    function fetchProduct($id)
    {
        $this->db->query("SELECT
                            p.id, p.product_name, p.stocks, p.description,
                            p.buying_price, p.selling_price, c.category_name,
                            c.id AS category_id
                        FROM 
                            product AS p
                        INNER JOIN 
                            category AS c ON p.category_id = c.id 
                        WHERE
                            p.id = $id
                        AND
                            p.isHidden = 0
                        ");
        return $this->db->fetch();
    }

    function getPopularProduct()
    {
        $this->db->query("SELECT
                            p.id, p.product_name, p.stocks,
                            p.buying_price, p.selling_price, c.category_name,
                            COUNT(ti.product_id) AS total_sales
                        FROM 
                            product AS p
                        INNER JOIN 
                            category AS c ON p.category_id = c.id 
                        LEFT JOIN 
                            transaction_items AS ti ON p.id = ti.product_id
                        WHERE
                            p.isHidden = 0
                        GROUP BY 
                            p.id
                        ORDER BY 
                            total_sales DESC
                        LIMIT 
                            4
                        ");
        return $this->db->fetchAll();
    }

    function getAllProduct()
    {
        $this->db->query("SELECT
                            p.id, p.product_name, p.stocks,
                            p.buying_price, p.selling_price, c.category_name
                        FROM 
                            product AS p
                        INNER JOIN 
                            category AS c ON p.category_id = c.id 
                        WHERE
                            p.isHidden = 0
                        ORDER BY
                            p.product_name
                        ");
        return $this->db->fetchAll();
    }

    function addProduct($name, $category_id, $description, $stocks, $buying_price, $selling_price)
    {
        $this->db->query("INSERT INTO 
                            product 
                            (product_name, date, category_id, description, stocks, buying_price, selling_price)
                        VALUES 
                            ('$name', NOW(), $category_id, '$description', $stocks, $buying_price, $selling_price)
                        ");
        $this->db->execute();
    }

    function editProduct($name, $category_id, $description, $stocks, $buying_price, $selling_price, $id)
    {
        $this->db->query("UPDATE 
                            product 
                        SET
                            product_name = '$name', category_id = $category_id, description = '$description', 
                            stocks = $stocks, buying_price = $buying_price, selling_price = $selling_price
                        WHERE 
                            id = $id
                        ");

        $this->db->execute();
    }

    function deleteProduct($id)
    {
        $this->db->query("UPDATE 
                            product
                        SET
                            isHidden = 1
                        WHERE
                            id = $id
                        ");

        $this->db->execute();
    }

    function addRequestProduct($name, $category_id, $description, $stocks, $buying_price, $selling_price, $user_id)
    {
        $this->db->query("INSERT INTO 
                            add_product_log 
                            (product_name, date, category_id, description, stocks, buying_price, selling_price, user_id)
                        VALUES 
                            ('$name', NOW(), $category_id, '$description', $stocks, $buying_price, $selling_price, $user_id)
                        ");

        $this->db->execute();
    }

    function addRequestStock($id, $stocks, $user_id)
    {
        $this->db->query("INSERT INTO 
                            add_stock_log 
                            (product_id, date, stocks, user_id)
                        VALUES 
                            ($id, NOW(), $stocks, $user_id)
                        ");

        $this->db->execute();
    }

    function changeStatusRequestProduct($id, $status)
    {
        $this->db->query("UPDATE 
                            add_product_log
                        SET 
                            status = '$status'
                        WHERE
                            id = $id
                        ");
        $this->db->execute();
    }

    function changeStatusRequestStock($id, $status)
    {
        $this->db->query("UPDATE 
                            add_stock_log
                        SET 
                            status = '$status'
                        WHERE
                            id = $id
                        ");
        $this->db->execute();
    }
}
