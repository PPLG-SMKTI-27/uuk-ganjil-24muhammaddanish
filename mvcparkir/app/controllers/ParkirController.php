<?php
// app/controllers/ParkirController.php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Parkir.php';

class ParkirController extends Controller {
    public function __construct($config){ parent::__construct($config); $this->parkir=new Parkir($config); }
    public function index(){ $this->requireLogin(); $this->view('parkir/index',['data'=>$this->parkir->getActive()]); }
    public function create(){
        $this->requireRole(['petugas','admin']);
        if ($_SERVER['REQUEST_METHOD']==='POST'){
            $plat=trim($_POST['plat']??''); $jenis=$_POST['jenis']??'roda2';
            $this->parkir->masuk($plat,$jenis,$_SESSION['user']['id']);
            $this->setFlash('success','Kendaraan masuk dicatat');
            $this->redirect('/');
        }
        $this->view('parkir/create');
    }
    public function keluar($id=null){
        $this->requireRole(['petugas','admin']);
        if (!$id) $this->redirect('/');
        $this->parkir->keluar($id);
        $this->setFlash('success','Kendaraan keluar. Biaya dihitung otomatis.');
        $this->redirect('/');
    }
    public function history(){ $this->requireLogin(); $this->view('parkir/history',['history'=>$this->parkir->history(200)]); }
}
