<?php
// app/controllers/UserController.php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/User.php';

class UserController extends Controller {
    public function __construct($config){ parent::__construct($config); $this->user=new User($config); }
    public function index(){ $this->requireRole(['admin']); $this->view('users/index',['users'=>$this->user->all()]); }
    public function create(){
        $this->requireRole(['admin']);
        if ($_SERVER['REQUEST_METHOD']==='POST'){
            $this->user->create($_POST['username'], $_POST['password'], $_POST['role']);
            $this->setFlash('success','User dibuat'); $this->redirect('/?url=user');
        }
        $this->view('users/create');
    }
    public function edit($id=null){
        $this->requireRole(['admin']);
        if (!$id) $this->redirect('/?url=user');
        if ($_SERVER['REQUEST_METHOD']==='POST'){
            $this->user->update($id,$_POST['username'],$_POST['password']??'',$_POST['role']);
            $this->setFlash('success','User diperbarui'); $this->redirect('/?url=user');
        }
        $this->view('users/edit',['user'=>$this->user->find($id)]);
    }
    public function delete($id=null){
        $this->requireRole(['admin']);
        if ($id) $this->user->delete($id);
        $this->setFlash('success','User dihapus'); $this->redirect('/?url=user');
    }
}
