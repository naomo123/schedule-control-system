<?php
include_once "Model/Usuario.php";
include_once "Controller.php";
class HomeController extends Controller
{
    private $model;
    function __construct()
    {
        $this->AuthorizeLogin();
        $this->model = new Usuario();
    }
    public function Login()
    {
        if (isset($_POST['submit'])) {
            if ($this->model->login($_POST)) {
                header("location: " . PATH . "/Admin/Index");
            } else {
                $viewBag = array();
                $viewBag['error_log'] = ['invalid_credentials' => 'Credenciales inválidas'];
                $this->render("Login", $viewBag);
            }
        } else
            $this->render("Login");
    }
    public function Logout()
    {
        session_unset();
        header("location: " . PATH . "/Home/Login");
    }
}
