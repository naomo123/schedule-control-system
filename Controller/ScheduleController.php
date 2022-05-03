<?php
include_once "Controller.php";
include_once "Model/Horario.php";
include_once "Core/Validate.php";
class ScheduleController extends Controller
{
    private $modelH;
    function __construct()
    {
        $this->Authorize();
        $this->AuthorizeRole([1]);
        $this->modelH = new Horario();
    }
    public function Index()
    {
        $viewBag = array();
        $viewBag['horarios'] = $this->modelH->get();
        $this->render("Index", $viewBag);
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
                $this->modelH->set($_POST);
                header("location: " . PATH . "/Schedule/Index");
                $viewBag['error_log'] = $error_log;
            }
        }
        $viewBag['horarios'] = $this->modelH->get();
        $this->render('Index', $viewBag);
    }
    public function Edit($id)
    {
        $error_log = array();
        $viewBag = array();
        $data_temp = $this->modelH->get($id);
        $data_temp["open_edit"] = true;
        if (isset($_POST["save"])) {
            extract($_POST);
            $error_log = $this->validate();
            if (count($error_log) > 0) {
                $viewBag['error_log'] = $error_log;
                $viewBag['data_temp'] = $data_temp;
            } else {
                $_POST["id"] = $id;
                $this->modelH->update($_POST);
                $viewBag['error_log'] = $error_log;
                header("location: ".PATH."/Schedule/Index");
            }
        }
        $viewBag['data_temp'] = $data_temp;
        $viewBag['horarios'] = $this->modelH->get();
        $this->render('Index', $viewBag);
    }
    public function Delete($id){
        $this->modelH->delete($id);
        header("location: ".PATH."/Schedule/Index");
    }
    private function validate()
    {
        extract($_POST);
        $error_log = array();
        if (!isset($nombre) || isEmpty($nombre))
            $error_log["nombre_error"] = "Este campo es obligatorio.";
        else if (!isText($nombre))
            $error_log["nombre_error"] = "Debes ingresar solamente letras";

        if (!isset($horaInicio) || isEmpty($horaInicio))
            $error_log["horaInicio_error"] = "Este campo es obligatorio.";

        if (!isset($horaFin) || isEmpty($horaFin))
            $error_log["horaFin_error"] = "Este campo es obligatorio.";

        if (!isset($days) || count($days) == 0)
            $error_log["days_error"] = "Este campo es obligatorio.";

        return $error_log;
    }
}
