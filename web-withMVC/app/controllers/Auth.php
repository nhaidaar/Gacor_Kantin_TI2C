<?php
class Auth extends Controller
{
    public function index()
    {
        session_start();

        // Cek apakah level sudah di set di SESSION (User sudah login sebelumnya)
        // Jika iya arahkan ke dashboard
        // Jika tidak set view ke halaman login

        if (isset($_SESSION['level'])) {
            header("Location: " . BASEURL . "dashboard");
        } else {
            $this->view('login');
        }
    }

    public function login()
    {
        session_start();

        // Ambil request POST username dan password
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Ambil data user berdasarkan username
        $user = $this->model('AuthModel')->getUser($username);


        // Jika username ada dan password benar, maka set data SESSION yang diperlukan dan arahkan ke dashboard
        // Jika tidak, maka arahkan ke halaman default (login)
        if ($user != null && $user['password'] == $password) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['level'] = $user['level'];

            header("Location: " . BASEURL . "dashboard");
        } else {
            header("Location: " . BASEURL);
        }
    }

    public function logout()
    {
        session_start();

        // Destroy session yang ada dan arahkan ke halaman default (login)
        session_destroy();
        header("Location: " . BASEURL);
    }
}
