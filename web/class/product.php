<?php

class Product
{
    private $koneksi;

    public function __construct($connection)
    {
        $this->koneksi = $connection;
    }

    function showAllProduct()
    {
        $query = "SELECT * 
                FROM 
                    product 
                INNER JOIN 
                    category 
                WHERE 
                    product.category_id = category.id 
                ";
        $result = mysqli_query($this->koneksi, $query);
        $products = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }

        return $products;
    }
}
