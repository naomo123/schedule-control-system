<?php
include_once "Controller.php";
include_once "Model/Usuario.php";
include_once "Core/Validate.php";
class AdminController extends Controller
{
    private $model;
    function __construct()
    {
        $this->Authorize();
        $this->AuthorizeRole([1]);
        $this->model = new Usuario();
    }
    public function Index()
    {
        $viewBag = array();
        $viewBag['usuarios'] = $this->model->get();
        $this->render("Index", $viewBag);
    }
    public function Create()
    {
        $error_log = array();
        $viewBag = array();
        if (isset($_POST["save"])) {
            $data_temp = $_POST;
            extract($_POST);
            $error_log = $this->validatePost();
            if (count($error_log) > 0) {
                $data_temp["open_create"] = true;
                $viewBag['error_log'] = $error_log;
                $viewBag['data_temp'] = $data_temp;
            } else {
                if ($this->model->existsCode($id) != null) {
                    $data_temp["open_create"] = true;
                    $error_log['id_error'] = 'El codigo ingresado ya existe';
                    $viewBag['data_temp'] = $data_temp;
                } else if ($this->model->existsEmail($email) != null) {
                    $data_temp["open_create"] = true;
                    $error_log['email_error'] = 'El correo ingresado ya existe';
                    $viewBag['data_temp'] = $data_temp;
                } else {
                    $this->model->set($_POST);
                    header("location: ".PATH."/Admin/Index");
                }
                $viewBag['error_log'] = $error_log;
            }
        }
        $viewBag['usuarios'] = $this->model->get();
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
            $error_log = $this->validateEdit();
            if (count($error_log) > 0) {
                $viewBag['error_log'] = $error_log;
                $viewBag['data_temp'] = $data_temp;
            } else {
                $this->model->update($_POST);
                $viewBag['error_log'] = $error_log;
                header("location: ".PATH."/Admin/Index");
            }
        }
        $viewBag['data_temp'] = $data_temp;
        $viewBag['usuarios'] = $this->model->get();
        $this->render('Index', $viewBag);
    }
    public function Delete($id){
        $this->model->delete($id);
        header("location: ".PATH."/Admin/Index");
    }
    private function validatePost()
    {
        extract($_POST);
        $error_log = array();
        if (!isset($id) || isEmpty($id))
            $error_log["id_error"] = "Este campo es obligatorio.";
        else if (!isCode($id))
            $error_log["id_error"] = "Debes ingresar un código válido. Ej: EXXXXX";

        if (!isset($name) || isEmpty($name))
            $error_log["name_error"] = "Este campo es obligatorio.";
        else if (!isText($id))
            $error_log["name_error"] = "Debes ingresar solamente letras";

        if (!isset($lastName) || isEmpty($lastName))
            $error_log["lastName_error"] = "Este campo es obligatorio.";
        else if (!isText($id))
            $error_log["lastName_error"] = "Debes ingresar solamente letras";

        if (!isset($birthdate) || isEmpty($birthdate))
            $error_log["birthdate_error"] = "Este campo es obligatorio.";

        if (!isset($email) || isEmpty($email))
            $error_log["email_error"] = "Este campo es obligatorio.";
        else if (!isEmail($email))
            $error_log["email_error"] = "Debes ingresar un correo electrónico válido.";

        if (!isset($telephone) || isEmpty($telephone))
            $error_log["telephone_error"] = "Este campo es obligatorio.";
        else if (!isTelephone($telephone))
            $error_log["telephone_error"] = "Debes ingresar un telefono válido.";

        if (!isset($dui) || isEmpty($dui))
            $error_log["dui_error"] = "Este campo es obligatorio.";
        else if (!isLicense($dui))
            $error_log["dui_error"] = "Debes ingresar un DUI válido.";

        if (!isset($extraHours) || isEmpty($extraHours))
            $error_log["extraHours_error"] = "Este campo es obligatorio.";
        else if (!is_numeric($extraHours))
            $error_log["extraHours_error"] = "Debes ingresar solamente números.";

        if (!isset($positionId) || isEmpty($positionId))
            $error_log["positionId_error"] = "Este campo es obligatorio.";

        return $error_log;
    }
    private function validateEdit()
    {
        extract($_POST);
        $error_log = array();
        if (!isset($name) || isEmpty($name))
            $error_log["name_error"] = "Este campo es obligatorio.";
        else if (!isText($id))
            $error_log["name_error"] = "Debes ingresar solamente letras";

        if (!isset($lastName) || isEmpty($lastName))
            $error_log["lastName_error"] = "Este campo es obligatorio.";
        else if (!isText($id))
            $error_log["lastName_error"] = "Debes ingresar solamente letras";

        if (!isset($birthdate) || isEmpty($birthdate))
            $error_log["birthdate_error"] = "Este campo es obligatorio.";

        if (!isset($telephone) || isEmpty($telephone))
            $error_log["telephone_error"] = "Este campo es obligatorio.";
        else if (!isTelephone($telephone))
            $error_log["telephone_error"] = "Debes ingresar un telefono válido.";

        if (!isset($dui) || isEmpty($dui))
            $error_log["dui_error"] = "Este campo es obligatorio.";
        else if (!isLicense($dui))
            $error_log["dui_error"] = "Debes ingresar un DUI válido.";

        if (!isset($extraHours) || isEmpty($extraHours))
            $error_log["extraHours_error"] = "Este campo es obligatorio.";
        else if (!is_numeric($extraHours))
            $error_log["extraHours_error"] = "Debes ingresar solamente números.";

        if (!isset($positionId) || isEmpty($positionId))
            $error_log["positionId_error"] = "Este campo es obligatorio.";

        return $error_log;
    }
}
