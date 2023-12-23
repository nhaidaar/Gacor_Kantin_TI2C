<?php
class Auth extends Controller
{
    public function index()
    {
        session_start();

        // Cek apakah ada parameter level di SESSION
        // (User sudah login)
        if (isset($_SESSION['level'])) {
            header("Location: " . BASEURL . "dashboard");
        } else {
            $this->view('login');
        }
    }

    public function login()
    {
        session_start();

        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $this->model('AuthModel')->getUser($username, $password);

        // Cek apakah di dalam result ada kolom level
        // (Username dan Password benar)
        if (isset($user['level'])) {
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

        session_destroy();
        header("Location: " . BASEURL);
    }
}
