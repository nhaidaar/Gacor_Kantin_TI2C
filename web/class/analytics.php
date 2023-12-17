<?php
class Analytics
{
    private $koneksi;

    function __construct($connection)
    {
        $this->koneksi = $connection;
    }

    function fetchIncome($monthordate)
    {
        $query = "SELECT 
                    SUM(ti.total_price) AS income
                FROM 
                    transactions AS t
                INNER JOIN 
                    transaction_items AS ti ON t.id = ti.transactions_id
                WHERE 
                    $monthordate(t.date) = $monthordate(NOW())
                AND
                    YEAR(t.date) = YEAR(NOW())";

        $result = mysqli_query($this->koneksi, $query);
        $row = mysqli_fetch_assoc($result);

        return $row['income'] != NULL ? $row['income'] : 0;
    }

    function fetchPreviousIncome($monthordate)
    {
        $query = "SELECT 
                    SUM(ti.total_price) AS income
                FROM 
                    transactions AS t
                INNER JOIN 
                    transaction_items AS ti ON t.id = ti.transactions_id
                WHERE 
                    $monthordate(t.date) = $monthordate(NOW()) - 1
                AND
                    YEAR(t.date) = YEAR(NOW())";

        $result = mysqli_query($this->koneksi, $query);
        $row = mysqli_fetch_assoc($result);

        return $row['income'] != NULL ? $row['income'] : 0;
    }

    function getIncomePercentage($monthordate)
    {
        $now = $this->fetchIncome($monthordate);
        $previous = $this->fetchPreviousIncome($monthordate);

        if ($previous != 0) {
            $growthPercentage = (($now - $previous) / $previous) * 100;
        } else {
            // Handle division by zero or no previous month income case
            $growthPercentage = ($now > 0) ? 100 : 0;
        }

        return $growthPercentage;
    }

    function fetchProfit($monthordate)
    {
        $query = "SELECT 
                   SUM((ti.total_price - (p.buying_price * ti.qty))) AS profit
                FROM 
                    transactions AS t
                JOIN 
                    transaction_items AS ti ON t.id = ti.transactions_id
                JOIN 
                    product AS p ON ti.product_id = p.id
                WHERE 
                    $monthordate(t.date) = $monthordate(NOW())
                AND
                    YEAR(t.date) = YEAR(NOW())";

        $result = mysqli_query($this->koneksi, $query);
        $row = mysqli_fetch_assoc($result);

        return $row['profit'] != NULL ? $row['profit'] : 0;
    }

    function fetchPreviousProfit($monthordate)
    {
        $query = "SELECT 
                   SUM((ti.total_price - (p.buying_price * ti.qty))) AS profit
                FROM 
                    transactions AS t
                JOIN 
                    transaction_items AS ti ON t.id = ti.transactions_id
                JOIN 
                    product AS p ON ti.product_id = p.id
                WHERE 
                    $monthordate(t.date) = $monthordate(NOW()) - 1
                AND
                    YEAR(t.date) = YEAR(NOW())";

        $result = mysqli_query($this->koneksi, $query);
        $row = mysqli_fetch_assoc($result);

        return $row['profit'] != NULL ? $row['profit'] : 0;
    }

    function getProfitPercentage($monthordate)
    {
        $now = $this->fetchProfit($monthordate);
        $previous = $this->fetchPreviousProfit($monthordate);

        if ($previous != 0) {
            $growthPercentage = (($now - $previous) / $previous) * 100;
        } else {
            // Handle division by zero or no previous month Profit case
            $growthPercentage = ($now > 0) ? 100 : 0;
        }

        return $growthPercentage;
    }

    function monthlyIncome()
    {
        $monthly = $this->fetchIncome('MONTH');
        $percentage = $this->getIncomePercentage('MONTH');
        echo '<div class="container">
                <div class="title-row">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none">
                        <rect width="31" height="31" x=".5" y=".5" fill="#fff" rx="15.5" />
                        <rect width="31" height="31" x=".5" y=".5" stroke="#EBEBEB" rx="15.5" />
                        <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.5 13.5h15M16 21.833h-5a2.5 2.5 0 0 1-2.5-2.5v-6.666a2.5 2.5 0 0 1 2.5-2.5h10a2.5 2.5 0 0 1 2.5 2.5v4.166M21 23.5l1.667-1.666m-3.334 0L21 23.5m0-4.166V23.5m-7.5-6.667h-1.667" />
                    </svg>

                    <div class="title">Monthly Income</div>
                </div>
                <div class="item-row">
                    <div class="income">IDR ' . $monthly . '</div>'
            . ($percentage < 0
                ? '<div class="percentage-row">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" fill="none">
                            <path stroke="#EC1A1A" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="m2.5 9.25 7-7m-7 1.865V9.25h5.135M1.75 11.5h8.5" />
                        </svg>
                        <div class="percentage">' . $percentage . '%</div>
                    </div>'
                : '<div class="percentage-row" style="background-color: rgba(0, 115, 27, 0.12); border: 1.5px rgba(0, 115, 27, 0.5) solid;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" fill="none">
                            <path stroke="#00731B" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M10.25 11.5h-8.5M9.5 2.25l-7 7m7-1.865V2.25H4.365"/>
                        </svg>
                        <div class="percentage" style="color: #00731B;">' . $percentage . '%</div>
                    </div>')  .
            '</div>
            </div>';
    }

    function dailyIncome()
    {
        $daily = $this->fetchIncome('DATE');
        $percentage = $this->getIncomePercentage('DATE');
        echo '<div class="container">
                <div class="title-row">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none">
                        <rect width="31" height="31" x=".5" y=".5" fill="#fff" rx="15.5" />
                        <rect width="31" height="31" x=".5" y=".5" stroke="#EBEBEB" rx="15.5" />
                        <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.5 13.5h15M16 21.833h-5a2.5 2.5 0 0 1-2.5-2.5v-6.666a2.5 2.5 0 0 1 2.5-2.5h10a2.5 2.5 0 0 1 2.5 2.5v4.166M21 23.5l1.667-1.666m-3.334 0L21 23.5m0-4.166V23.5m-7.5-6.667h-1.667" />
                    </svg>

                    <div class="title">Daily Income</div>
                </div>
                <div class="item-row">
                    <div class="income">IDR ' . $daily . '</div>'
            . ($percentage < 0
                ? '<div class="percentage-row">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" fill="none">
                            <path stroke="#EC1A1A" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="m2.5 9.25 7-7m-7 1.865V9.25h5.135M1.75 11.5h8.5" />
                        </svg>
                        <div class="percentage">' . $percentage . '%</div>
                    </div>'
                : '<div class="percentage-row" style="background-color: rgba(0, 115, 27, 0.12); border: 1.5px rgba(0, 115, 27, 0.5) solid;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" fill="none">
                            <path stroke="#00731B" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M10.25 11.5h-8.5M9.5 2.25l-7 7m7-1.865V2.25H4.365"/>
                        </svg>
                        <div class="percentage" style="color: #00731B;">' . $percentage . '%</div>
                    </div>')  .
            '</div>
            </div>';
    }

    function dailyProfit()
    {
        $daily = $this->fetchProfit('DATE');
        $percentage = $this->getProfitPercentage('DATE');
        echo '<div class="container">
                <div class="title-row">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none">
                        <rect width="31" height="31" x=".5" y=".5" fill="#fff" rx="15.5" />
                        <rect width="31" height="31" x=".5" y=".5" stroke="#EBEBEB" rx="15.5" />
                        <path stroke="#1B1B1B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.5 13.5h15M16 21.833h-5a2.5 2.5 0 0 1-2.5-2.5v-6.666a2.5 2.5 0 0 1 2.5-2.5h10a2.5 2.5 0 0 1 2.5 2.5v4.166M21 19.334 19.333 21m3.334 0L21 19.334m0 4.166v-4.166m-7.5-2.501h-1.667" />
                    </svg>

                    <div class="title">Daily Profit</div>
                </div>
                <div class="item-row">
                    <div class="income">IDR ' . $daily . '</div>'
            . ($percentage < 0
                ? '<div class="percentage-row">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" fill="none">
                            <path stroke="#EC1A1A" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="m2.5 9.25 7-7m-7 1.865V9.25h5.135M1.75 11.5h8.5" />
                        </svg>
                        <div class="percentage">' . $percentage . '%</div>
                    </div>'
                : '<div class="percentage-row" style="background-color: rgba(0, 115, 27, 0.12); border: 1.5px rgba(0, 115, 27, 0.5) solid;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" fill="none">
                            <path stroke="#00731B" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M10.25 11.5h-8.5M9.5 2.25l-7 7m7-1.865V2.25H4.365"/>
                        </svg>
                        <div class="percentage" style="color: #00731B;">' . $percentage . '%</div>
                    </div>')  .
            '</div>
            </div>';
    }
}
