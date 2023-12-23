<?php
class Notification extends Controller
{
    public function index()
    {
        session_start();

        $data['page'] = 'notification';
        $data['count_pending'] = $this->model('NotificationModel')->countPending();

        $data['notification'] = $this->model('NotificationModel')->getNotification();

        $this->view('template/header', $data);
        $this->view('notification/index', $data);
    }

    public function productdetail($id = 0)
    {
        session_start();

        if ($id != 0) {
            if ($_SESSION['level'] == 'admin') {
                $data['page'] = 'notification';
                $data['count_pending'] = $this->model('NotificationModel')->countPending();
                $data['product'] = $this->model('NotificationModel')->fetchProduct($id);

                $this->view('template/header', $data);
                $this->view('notification/product_details', $data);
            } else {
                header("Location: " . BASEURL . "notification");
            }
        } else {
            header("Location: " . BASEURL . "notification");
        }
    }
    public function stockdetail($id = 0)
    {
        session_start();

        if ($id != 0) {
            if ($_SESSION['level'] == 'admin') {
                $data['page'] = 'notification';
                $data['count_pending'] = $this->model('NotificationModel')->countPending();
                $data['stock'] = $this->model('NotificationModel')->fetchStock($id);

                $this->view('template/header', $data);
                $this->view('notification/stock_details', $data);
            } else {
                header("Location: " . BASEURL . "notification");
            }
        } else {
            header("Location: " . BASEURL . "notification");
        }
    }
}
