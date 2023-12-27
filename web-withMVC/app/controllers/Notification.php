<?php
class Notification extends Controller
{
    public function index()
    {
        session_start();

        // Set the active menu is Notification, pending request count, and get all notification
        $data['page'] = 'notification';
        $data['count_pending'] = $this->model('NotificationModel')->countPending();
        $data['notification'] = $this->model('NotificationModel')->getNotification();

        // Show the page
        $this->view('template/header', $data);
        $this->view('notification/index', $data);
    }

    public function productdetail($id = 0)
    {
        session_start();

        // Set the active menu is Notification, pending request count, and fetch the request detail
        $data['page'] = 'notification';
        $data['count_pending'] = $this->model('NotificationModel')->countPending();
        $data['product'] = $this->model('NotificationModel')->fetchProduct($id);

        // Check the parameter (id of product request) and permission to access (user level)
        if ($id != 0) {
            if ($_SESSION['level'] == 'admin') {
                // Show the page
                $this->view('template/header', $data);
                $this->view('notification/product_details', $data);
            } else {
                // Show 403 Forbidden Page
                $this->view('template/header', $data);
                $this->view('template/403', $data);
            }
        } else {
            // Show 404 Not Found Page
            $this->view('template/header', $data);
            $this->view('template/404', $data);
        }
    }
    public function stockdetail($id = 0)
    {
        session_start();

        // Set the active menu is Notification, pending request count, and fetch the request detail
        $data['page'] = 'notification';
        $data['count_pending'] = $this->model('NotificationModel')->countPending();
        $data['stock'] = $this->model('NotificationModel')->fetchStock($id);

        // Check the parameter (id of product request) and permission to access (user level)
        if ($id != 0) {
            if ($_SESSION['level'] == 'admin') {
                // Show the page
                $this->view('template/header', $data);
                $this->view('notification/stock_details', $data);
            } else {
                // Show 403 Forbidden Page
                $this->view('template/header', $data);
                $this->view('template/403', $data);
            }
        } else {
            // Show 404 Not Found Page
            $this->view('template/header', $data);
            $this->view('template/404', $data);
        }
    }
}
