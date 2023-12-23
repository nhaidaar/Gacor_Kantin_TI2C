<?php

class Product extends Controller
{
    public function index()
    {
        session_start();

        $data['page'] = 'product';
        $data['count_pending'] = $this->model('NotificationModel')->countPending();
        $data['product'] = $this->model('ProductModel')->getAllProduct();

        $this->view('template/header', $data);
        $this->view('product/index', $data);
    }

    public function add()
    {
        session_start();

        $data['page'] = 'product';
        $data['count_pending'] = $this->model('NotificationModel')->countPending();
        $data['category'] = $this->model('ProductModel')->getCategory();

        $this->view('template/header', $data);

        if ($_SESSION['level'] == 'admin') {
            $this->view('product/add_product', $data);
        } else {
            $this->view('product/request_product', $data);
        }
    }

    public function edit($id)
    {
        session_start();

        $data['page'] = 'product';
        $data['count_pending'] = $this->model('NotificationModel')->countPending();
        $data['category'] = $this->model('ProductModel')->getCategory();
        $data['product'] = $this->model('ProductModel')->fetchProduct($id);

        if ($_SESSION['level'] == 'admin') {
            $this->view('template/header', $data);
            $this->view('product/edit_product', $data);
        } else {
            header("Location: " . BASEURL);
        }
    }

    public function delete($id)
    {
        session_start();

        $data['page'] = 'product';
        $data['count_pending'] = $this->model('NotificationModel')->countPending();
        $data['product'] = $this->model('ProductModel')->fetchProduct($id);

        if ($_SESSION['level'] == 'admin') {
            $this->view('template/header', $data);
            $this->view('product/delete_product', $data);
        } else {
            header("Location: " . BASEURL);
        }
    }

    public function requeststock($id)
    {
        session_start();

        $data['page'] = 'product';
        $data['count_pending'] = $this->model('NotificationModel')->countPending();
        $data['product'] = $this->model('ProductModel')->fetchProduct($id);

        if ($_SESSION['level'] == 'user') {
            $this->view('template/header', $data);
            $this->view('product/request_stock', $data);
        }
    }

    public function requestproduct_approval($id, $status)
    {
        session_start();

        if ($_SESSION['level'] == 'admin') {
            $this->model('ProductModel')->changeStatusRequestProduct($id, $status);
            header("Location: " . BASEURL . 'notification');
        }
    }

    public function requeststock_approval($id, $status)
    {
        session_start();

        if ($_SESSION['level'] == 'admin') {
            $this->model('ProductModel')->changeStatusRequestStock($id, $status);
            header("Location: " . BASEURL . 'notification');
        }
    }

    public function editproduct_send()
    {
        session_start();

        $id = $_POST['id'];
        $name = $_POST['name'];
        $category_id = $_POST['category_id'];
        $description = $_POST['desc'];
        $stocks = $_POST['stock'];
        $buying_price = $_POST['bprice'];
        $selling_price = $_POST['sprice'];

        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $target_dir = "../public/assets/products/";

        $target_file = $target_dir . $name . ".png";
        move_uploaded_file($image_tmp, $target_file);

        $this->model('ProductModel')->editProduct($name, $category_id, $description, $stocks, $buying_price, $selling_price, $id);

        header("Location: " . BASEURL . 'product');
    }

    public function deleteproduct_send()
    {
        session_start();

        $id = $_POST['id'];

        $this->model('ProductModel')->deleteProduct($id);

        header("Location: " . BASEURL . 'product');
    }

    public function requestproduct_send()
    {
        session_start();

        $user_id = $_SESSION['id'];
        $name = $_POST['name'];
        $category_id = $_POST['category_id'];
        $description = $_POST['desc'];
        $stocks = $_POST['stock'];
        $buying_price = $_POST['bprice'];
        $selling_price = $_POST['sprice'];

        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $target_dir = "../public/assets/products/";

        $target_file = $target_dir . $name . ".png";
        move_uploaded_file($image_tmp, $target_file);

        $this->model('ProductModel')->addRequestProduct($name, $category_id, $description, $stocks, $buying_price, $selling_price, $user_id);

        header("Location: " . BASEURL . 'notification');
    }

    public function requeststock_send()
    {
        session_start();
        $id = $_POST['id'];
        $stocks = $_POST['stock'];
        $user_id = $_SESSION['id'];

        $this->model('ProductModel')->addRequestStock($id, $stocks, $user_id);

        header("Location: " . BASEURL . 'notification');
    }
}
