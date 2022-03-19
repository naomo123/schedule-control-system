<?php
include_once "Controller.php";
class AdminController extends Controller
{
    private $model;
    function __construct()
    {
        $this->Authorize();
        //$this->model = new Usuario();
    }
    public function Index()
    {
        $this->render("Index");
    }
}
