<?php
include_once "Controller.php";
include_once "Model/Assistance.php";
include_once "Model/Usuario.php";
class AssistanceController extends Controller
{
    private $modelA;
    private $modelU;
    function __construct()
    {
        $this->Authorize();
        $this->modelA = new Assistance();
        $this->modelU = new Usuario();
    }
    public function Index()
    {
        $this->AuthorizeRole([2, 3, 4]);
        $viewBag = array();
        $viewBag['asistencias'] = $this->modelA->get($_SESSION["user"]["idUsuario"]);
        $this->render("Index", $viewBag);
    }
    public function IndexAdmin($id = "2")
    {
        $this->AuthorizeRole([1]);
        $viewBag = array();
        $viewBag['asistencias'] = $this->modelA->get($id);
        $viewBag['usuarios'] = $this->modelU->get();
        $viewBag['id'] = $id;
        $this->render("IndexAdmin", $viewBag);
    }
}
