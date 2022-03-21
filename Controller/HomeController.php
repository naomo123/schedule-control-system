<?php
include_once "Controller.php";
include_once "Model/Usuario.php";
include_once "Model/Assistance.php";
class HomeController extends Controller
{
    private $model;
    private $modelA;
    function __construct()
    {
        $this->model = new Usuario();
        $this->modelA = new Assistance();
    }
    public function Assistance()
    {
        if (isset($_POST['submit'])) {
            $code = $_POST['code'];
            $viewBag = array();
            $user = $this->model->existsCode($code);
            if ($user != null) {
                $img = $_POST['capture'];
                $img = str_replace('data:image/png;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);
                $fileName = $code . ' ' . uniqid() . '.png';
                $file = "wwwroot/assets/img/captures/" . $fileName;
                $success = file_put_contents($file, $data);
                $this->modelA->set(["id" => $user['idUsuario'], "image" => $fileName]);
                $viewBag['assistance_result'] = true;
            } else {
                $viewBag['assistance_result'] = false;
            }
            $this->render("Assistance", $viewBag);
        } else
            $this->render("Assistance");
    }
    public function Login()
    {
        $this->AuthorizeLogin();
        if (isset($_POST['submit'])) {
            if ($this->model->login($_POST)) {
                if ($_SESSION["user"]["idPuesto"] == 1)
                    header("location: " . PATH . "/Admin/Index");
                else
                    header("location: " . PATH . "/Client/Index");
            } else {
                $viewBag = array();
                $viewBag['error_log'] = ['invalid_credentials' => 'Credenciales inválidas'];
                $viewBag['temp_data'] = ['username' => $_POST['username']];
                $this->render("Login", $viewBag);
            }
        } else
            $this->render("Login");
    }
    public function Signin()
    {
        $this->AuthorizeLogin();
        if (isset($_POST['submit'])) {
            if ($this->model->existsCode($_POST['code'])) {
                if ($_POST["password"] != $_POST["passwordRepeat"]) {
                    $viewBag = array();
                    $viewBag['error_log'] = ['error' => 'Las contraseñas no coinciden'];
                    $viewBag['temp_data'] = ['code' => $_POST['code']];
                    $this->render("Signin", $viewBag);
                } else {
                    $viewBag = array();
                    $viewBag['temp_data'] = ['result' => $this->model->signin($_POST)];
                    $this->render("Login", $viewBag);
                }
            } else {
                $viewBag = array();
                $viewBag['error_log'] = ['error' => 'Código de empleado erróneo'];
                $this->render("Signin", $viewBag);
            }
        } else
            $this->render("Signin");
    }
    public function Logout()
    {
        session_unset();
        header("location: " . PATH . "/Home/Login");
    }
}
