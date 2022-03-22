<?php
include_once "Controller.php";
include_once "Model/Pago.php";
class PaymentController extends Controller
{
    private $modelP;
    function __construct()
    {
        $this->Authorize();
        $this->AuthorizeRole([2, 3, 4]);
        $this->modelP = new Pago();
    }
    public function Index()
    {
        $viewBag = array();
        $viewBag['pagos'] = $this->modelP->get($_SESSION["user"]["idUsuario"]);
        $this->render("Index", $viewBag);
    }
}
