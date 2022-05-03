<?php
include_once "Controller.php";
include_once "Model/Puesto.php";
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
}
