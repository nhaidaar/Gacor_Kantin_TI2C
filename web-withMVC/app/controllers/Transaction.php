<?php
class Transaction extends Controller
{
    public function index()
    {
        session_start();

        $data['page'] = 'transaction';
        $data['count_pending'] = $this->model('NotificationModel')->countPending();
        $data['transaction'] = $this->model('TransactionModel')->getAllTransaction();
        $this->view('template/header', $data);
        $this->view('transaction/index', $data);
    }

    public function add()
    {
        session_start();

        if ($_SESSION['level'] == 'user') {
            $data['page'] = 'transaction';
            $data['count_pending'] = $this->model('NotificationModel')->countPending();
            $this->view('template/header', $data);
            $this->view('transaction/add', $data);
        }
    }

    public function checkdetails($id = 0)
    {
        if ($id != 0) {
            $data['page'] = 'transaction';
            $data['count_pending'] = $this->model('NotificationModel')->countPending();
            $data['transaction'] = $this->model('TransactionModel')->fetchTransaction($id);
            $data['items'] = $this->model('TransactionModel')->fetchTransactionItems($id);
            $this->view('template/header', $data);
            $this->view('transaction/check_details', $data);
        } else {
            header("Location: " . BASEURL . "transaction");
        }
    }
}
