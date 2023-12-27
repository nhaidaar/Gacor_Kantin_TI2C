<?php
class Transaction extends Controller
{
    public function index()
    {
        session_start();

        $data['page'] = 'transaction';
        $data['count_pending'] = $this->model('NotificationModel')->countPending();

        if (isset($_POST['start']) && isset($_POST['end'])) {
            $start = $_POST['start'];
            $end = $_POST['end'];
            $data['transaction'] = $this->model('TransactionModel')->getFilteredTransaction($start, $end);
        } else {
            $data['transaction'] = $this->model('TransactionModel')->getAllTransaction();
        }

        $this->view('template/header', $data);
        $this->view('transaction/index', $data);
    }

    public function add()
    {
        session_start();

        $data['page'] = 'transaction';
        $data['count_pending'] = $this->model('NotificationModel')->countPending();

        if ($_SESSION['level'] == 'user') {
            $this->view('template/header', $data);
            $this->view('transaction/add', $data);
        } else {
            $this->view('template/header', $data);
            $this->view('template/403', $data);
        }
    }

    public function add_send()
    {
        session_start();

        $user_id = $_SESSION['id'];
        $dataRow = $_POST['dataRow'];

        $this->model('TransactionModel')->createTransaction($user_id, $dataRow);
    }

    public function checkdetails($id = 0)
    {
        $data['page'] = 'transaction';
        $data['count_pending'] = $this->model('NotificationModel')->countPending();
        $data['transaction'] = $this->model('TransactionModel')->fetchTransaction($id);
        $data['items'] = $this->model('TransactionModel')->fetchTransactionItems($id);

        if ($id != 0) {
            $this->view('template/header', $data);
            $this->view('transaction/check_details', $data);
        } else {
            $this->view('template/header', $data);
            $this->view('template/404', $data);
        }
    }

    public function searchProduct()
    {
        $input = $_POST['input'];

        $data['product'] = $this->model('TransactionModel')->searchProduct($input);

        if ($data['product'] == null) {
            echo '<span style="font-size: 14px; padding: 8px; font-weight: 400;">No results found.</span>';
        }
        foreach ($data['product'] as $product) {
            echo '<div data-id="' . $product['id'] . '" class="search-result-container">
            ' . $product['product_name'] . ' (Stocks: ' . $product['stocks'] . ')
            </div>';
        }
    }

    public function addToCart()
    {
        $id = $_POST['id'];

        $product = $this->model('ProductModel')->fetchProduct($id);

        echo '<tr>
            <td id="product_id">' . $product['id'] . '</td>
            <td>' . $product['product_name'] . '</td>
            <td>' . $product['stocks'] . '</td>
            <td><input class="seedetail" type="number" name="qty" id="qty" value="1" min="1" max="' . $product['stocks'] . '"></td>
            <td id="selling_price">' . $product['selling_price'] . '</td>
            <td id="eachtotal">' . $product['selling_price'] . '</td>
            <td class = "transaction-detail"><div id="cancel-row" class="request-stock" style="background-color: #EC1A1A; color: #fff; width: max-content;">Cancel</div></td>
        </tr>';
    }
}
