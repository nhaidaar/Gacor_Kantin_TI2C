<?php

class Dashboard extends Controller
{
    public function index()
    {
        session_start();

        // SET THE ACTIVE MENU IS DASHBOARD AND COUNT THE PENDING NOTIFICATION
        $data['page'] = 'dashboard';
        $data['count_pending'] = $this->model('NotificationModel')->countPending();

        // ANALYTICS SECTION
        $data['monthly_income'] = $this->model('AnalyticsModel')->fetchRecentIncome('MONTH');
        $data['monthly_income_percentage'] = $this->model('AnalyticsModel')->getIncomePercentage('MONTH');
        $data['daily_income'] = $this->model('AnalyticsModel')->fetchRecentIncome('DATE');
        $data['daily_income_percentage'] = $this->model('AnalyticsModel')->getIncomePercentage('DATE');
        $data['daily_profit'] = $this->model('AnalyticsModel')->fetchRecentProfit('DATE');
        $data['daily_profit_percentage'] = $this->model('AnalyticsModel')->getProfitPercentage('DATE');

        // GET 4 MOST POPULAR PRODUCT AND 5 RECENT TRANSACTION
        $data['product'] = $this->model('ProductModel')->getPopularProduct();
        $data['transaction'] = $this->model('TransactionModel')->getRecentTransaction(5);

        // PASS THE DATA TO HEADER AND BODY
        $this->view('template/header', $data);
        $this->view('dashboard/index', $data);
    }
}
