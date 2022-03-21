<?php
include_once "Controller.php";
include_once "Model/Horario.php";
class ClientController extends Controller
{
    private $modelH;
    function __construct()
    {
        $this->Authorize();
        $this->AuthorizeRole(2);
        $this->modelH = new Horario();
    }
    public function Index()
    {
        $viewBag = array();
        $viewBag['horarios'] = $this->modelH->get();
        $this->render("Index", $viewBag);
    }
    public function Schedule()
    {
        $viewBag = array();
        $viewBag['horarios'] = $this->modelH->get_actual();
        $this->render("Schedule", $viewBag);
    }
}
