<?php
// app/controllers/DashboardController.php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Parkir.php';

class DashboardController extends Controller {
    public function __construct($config){ parent::__construct($config); $this->parkir=new Parkir($config); }
    public function index(){
        $this->requireLogin();
        $active = $this->parkir->getActive();
        $history = $this->parkir->history(5);
        $this->view('dashboard/index',['active'=>$active,'history'=>$history]);
    }
}
