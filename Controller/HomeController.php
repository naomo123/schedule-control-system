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
