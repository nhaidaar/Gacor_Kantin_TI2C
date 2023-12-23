<?php
class AnalyticsModel
{
    private $db;

    function __construct()
    {
        $this->db = new Database;
    }

    function fetchRecentIncome($time)
    {
        $this->db->query("SELECT 
                            SUM(ti.total_price) AS income
                        FROM 
                            transactions AS t
                        INNER JOIN 
                            transaction_items AS ti ON t.id = ti.transactions_id
                        WHERE 
                            $time(t.date) = $time(NOW())
                        AND
                            YEAR(t.date) = YEAR(NOW())
                        ");
        $row = $this->db->fetch();
        return $row['income'] != NULL ? $row['income'] : 0;
    }

    function fetchPreviousIncome($time)
    {
        $this->db->query("SELECT 
                            SUM(ti.total_price) AS income
                        FROM 
                            transactions AS t
                        INNER JOIN 
                            transaction_items AS ti ON t.id = ti.transactions_id
                        WHERE 
                            $time(t.date) = $time(NOW()) - 1
                        AND
                            YEAR(t.date) = YEAR(NOW())
                        ");
        $row = $this->db->fetch();
        return $row['income'] != NULL ? $row['income'] : 0;
    }

    function fetchRecentProfit($time)
    {
        $this->db->query("SELECT 
                            SUM((ti.total_price - (p.buying_price * ti.qty))) AS profit
                        FROM 
                            transactions AS t
                        JOIN 
                            transaction_items AS ti ON t.id = ti.transactions_id
                        JOIN 
                            product AS p ON ti.product_id = p.id
                        WHERE 
                            $time(t.date) = $time(NOW())
                        AND
                            YEAR(t.date) = YEAR(NOW())
                        ");
        $row = $this->db->fetch();

        return $row['profit'] != NULL ? $row['profit'] : 0;
    }

    function fetchPreviousProfit($time)
    {
        $this->db->query("SELECT 
                            SUM((ti.total_price - (p.buying_price * ti.qty))) AS profit
                        FROM 
                            transactions AS t
                        JOIN 
                            transaction_items AS ti ON t.id = ti.transactions_id
                        JOIN 
                            product AS p ON ti.product_id = p.id
                        WHERE 
                            $time(t.date) = $time(NOW()) - 1
                        AND
                            YEAR(t.date) = YEAR(NOW())
                        ");
        $row = $this->db->fetch();

        return $row['profit'] != NULL ? $row['profit'] : 0;
    }

    function getIncomePercentage($time)
    {
        $now = $this->fetchRecentIncome($time);
        $previous = $this->fetchPreviousIncome($time);

        if ($previous != 0) {
            $growthPercentage = (($now - $previous) / $previous) * 100;
        } else {
            // Handle division by zero or no previous month income case
            $growthPercentage = ($now > 0) ? 100 : 0;
        }

        return $growthPercentage;
    }

    function getProfitPercentage($time)
    {
        $now = $this->fetchRecentProfit($time);
        $previous = $this->fetchPreviousProfit($time);

        if ($previous != 0) {
            $growthPercentage = (($now - $previous) / $previous) * 100;
        } else {
            // Handle division by zero or no previous month profit case
            $growthPercentage = ($now > 0) ? 100 : 0;
        }

        return $growthPercentage;
    }
}
