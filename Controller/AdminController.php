<?php
include_once "Controller.php";
include_once "Model/Usuario.php";
class AdminController extends Controller
{
    private $model;
    function __construct()
    {
        $this->Authorize();
        $this->AuthorizeRole(1);
        $this->model = new Usuario();
    }
    public function Index()
    {
        $viewBag = array();
        $viewBag['usuarios'] = $this->model->get();
        $this->render("Index", $viewBag);
    }
}
