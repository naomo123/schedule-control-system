<?php
include_once "Controller.php";
include_once "Model/Puesto.php";
include_once "Core/Validate.php";
class PositionController extends Controller
{
    private $model;
    function __construct()
    {
        $this->Authorize();
        $this->AuthorizeRole([1]);
        $this->model = new Puesto();
    }
    public function Index()
    {
        $viewBag = array();
        $viewBag['puestos'] = $this->model->get();
        $this->render("Index", $viewBag);
    }
    public function Get()
    {
        echo json_encode($this->model->get());
    }
    public function Create()
    {
        $error_log = array();
        $viewBag = array();
        if (isset($_POST["save"])) {
            $data_temp = $_POST;
            extract($_POST);
            $error_log = $this->validate();
            if (count($error_log) > 0) {
                $data_temp["open_create"] = true;
                $viewBag['error_log'] = $error_log;
                $viewBag['data_temp'] = $data_temp;
            } else {
                $this->model->set($_POST);
                header("location: " . PATH . "/Position/Index");
                $viewBag['error_log'] = $error_log;
            }
        }
        $viewBag['puestos'] = $this->model->get();
        $this->render('Index', $viewBag);
    }
    public function Edit($id)
    {
        $error_log = array();
        $viewBag = array();
        $data_temp = $this->model->get($id);
        $data_temp["open_edit"] = true;
        if (isset($_POST["save"])) {
            extract($_POST);
            $error_log = $this->validate();
            if (count($error_log) > 0) {
                $viewBag['error_log'] = $error_log;
                $viewBag['data_temp'] = $data_temp;
            } else {
                $_POST["idPuesto"] = $id;
                $this->model->update($_POST);
                $viewBag['error_log'] = $error_log;
                header("location: ".PATH."/Position/Index");
            }
        }
        $viewBag['data_temp'] = $data_temp;
        $viewBag['puestos'] = $this->model->get();
        $this->render('Index', $viewBag);
    }
    public function Delete($id){
        $this->model->delete($id);
        header("location: ".PATH."/Position/Index");
    }
    private function validate()
    {
        extract($_POST);
        $error_log = array();
        if (!isset($nombre) || isEmpty($nombre))
            $error_log["nombre_error"] = "Este campo es obligatorio.";
        else if (!isText($nombre))
            $error_log["nombre_error"] = "Debes ingresar solamente letras";  

        return $error_log;
    }
}
