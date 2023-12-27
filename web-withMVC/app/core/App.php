<?php
class App
{
    protected $controller = 'Auth';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        // Gunakan function parseUrl pada url yang dikirimkan
        $url = $this->parseUrl();

        // ==============
        // SET CONTROLLER
        // ==============
        if (isset($url[0])) { // Jika ada controller yang diminta
            if (file_exists('../app/controllers/' . $url[0] . '.php')) { // Cek apakah controller tersebut ada di dalam folder
                $this->controller = $url[0]; // Set $controller menjadi yang diminta
                unset($url[0]); // Hapus elemen controller dari array url
            } // Jika tidak ada, maka gunakan controller default (auth)
        }

        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller; // Instansiasi Controller

        // ==========
        // SET METHOD
        // ==========
        if (isset($url[1])) { // Jika ada method yang diminta
            if (method_exists($this->controller, $url[1])) { // Cek apakah controller tersebut ada di dalam controller
                $this->method = $url[1]; // Set $method menjadi yang diminta
                unset($url[1]); // Hapus elemen method dari array url
            } // Jika tidak ada, maka gunakan method default (index)
        }

        // UNSET URL DIGUNAKAN UNTUK MENYISAKAN ARRAY URL MENJADI TERSISA PARAMETER SAJA

        // ==========
        // SET PARAMS
        // ==========
        if (!empty($url)) { // Jika array url tidak kosong (ada parameter yang dikirimkan)
            $this->params = array_values($url); // Masukkan semua parameter ke dalam array
        }

        // ==============================================
        // RUN CONTROLLER, METHOD, AND PARAMS (if exists)
        // ==============================================
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl()
    {
        if (isset($_GET['url'])) { // Jika ada parameter url yang dikirimkan       
            $url = rtrim($_GET['url'], '/'); // Menghapus '/' di akhir url
            $url = filter_var($url, FILTER_SANITIZE_URL); // Mensterilkan url
            $url = explode('/', $url); // Memisahkan url menjadi bagian-bagian agar dapat dikelola
            return $url;
        }

        // URL dipisah berdasarkan '/' menjadi seperti berikut :
        // http://localhost/Gacor_Kantin_TI2C/web-withMVC/public/product/requestmethod_approval/1/approved/

        // (http://localhost/Gacor_Kantin_TI2C/web-withMVC/public/ merupakan BASEURL)
        // 1. product                   => controller
        // 2. requestmethod_approval    => method di dalam controller
        // 3. 1                         => parameter 1
        // 4. approved                  => parameter 2
    }
}
