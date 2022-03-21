<?php
include_once "Controller.php";
include_once "Model/Assistance.php";
class AssistanceController extends Controller
{
    private $modelA;
    function __construct()
    {
        $this->Authorize();
        $this->AuthorizeRole(2);
        $this->modelA = new Assistance();
    }
    public function Index()
    {
        $viewBag = array();
        $viewBag['asistencias'] = $this->modelA->get($_SESSION["user"]["idUsuario"]);
        $this->render("Index", $viewBag);
    }
}
