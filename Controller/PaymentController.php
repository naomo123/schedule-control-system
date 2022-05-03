<?php
include_once "Controller.php";
include_once "Model/Pago.php";
include_once "Model/Usuario.php";
include_once "Model/TipoPago.php";
include_once "Core/Validate.php";
class PaymentController extends Controller
{
    private $modelP;
    private $modelTP;
    private $modelU;
    function __construct()
    {
        $this->Authorize();
        $this->modelP = new Pago();
        $this->modelTP = new TipoPago();
        $this->modelU = new Usuario();
    }
    public function Index()
    {
        $this->AuthorizeRole([2, 3, 4]);
        $viewBag = array();
        $viewBag['pagos'] = $this->modelP->get($_SESSION["user"]["idUsuario"]);
        $this->render("Index", $viewBag);
    }
    public function IndexAdmin()
    {
        $this->AuthorizeRole([1]);
        $viewBag = array();
        $viewBag['pagos'] = $this->modelP->get();
        $viewBag['usuarios'] = $this->modelU->get();
        $viewBag['tipopagos'] = $this->modelTP->get();
        $this->render("IndexAdmin", $viewBag);
    }
    public function Create()
    {
        $this->AuthorizeRole([1]);
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
                $this->modelP->set($_POST);
                header("location: " . PATH . "/Payment/IndexAdmin");
                $viewBag['error_log'] = $error_log;
            }
        }
        $viewBag['pagos'] = $this->modelP->get();
        $viewBag['usuarios'] = $this->modelU->get();
        $viewBag['tipopagos'] = $this->modelTP->get();
        $this->render('IndexAdmin', $viewBag);
    }
    private function validate()
    {
        extract($_POST);
        $error_log = array();
        if (!isset($idUsuario) || isEmpty($idUsuario))
            $error_log["idUsuario_error"] = "Este campo es obligatorio.";

        if (!isset($idTipoPago) || isEmpty($idTipoPago))
            $error_log["idTipoPago_error"] = "Este campo es obligatorio.";

        if (!isset($fechaPago) || isEmpty($fechaPago))
            $error_log["fechaPago_error"] = "Este campo es obligatorio.";

        if (!isset($monto) || isEmpty($monto))
            $error_log["monto_error"] = "Este campo es obligatorio.";
        else if (!is_numeric($monto))
            $error_log["monto_error"] = "Debes ingresar solamente números.";

        if (!isset($isss) || isEmpty($isss))
            $error_log["isss_error"] = "Este campo es obligatorio.";
        else if (!is_numeric($isss))
            $error_log["isss_error"] = "Debes ingresar solamente números.";

        if (!isset($renta) || isEmpty($renta))
            $error_log["renta_error"] = "Este campo es obligatorio.";
        else if (!is_numeric($renta))
            $error_log["renta_error"] = "Debes ingresar solamente números.";

        return $error_log;
    }
}
