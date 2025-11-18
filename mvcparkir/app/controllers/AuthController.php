<?php
// app/controllers/AuthController.php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/User.php';

class AuthController extends Controller {
    public function __construct($config){ parent::__construct($config); $this->config=$config; }
    public function login(){
        if ($_SERVER['REQUEST_METHOD']==='POST'){
            $m = new User($this->config);
            $user = $m->findByUsername($_POST['username'] ?? '');
            if ($user && password_verify($_POST['password'] ?? '', $user['password'])){
                $_SESSION['user'] = ['id'=>$user['id'],'username'=>$user['username'],'role'=>$user['role']];
                $this->redirect('/');
            } else {
                $this->setFlash('error','Username atau password salah');
                $this->redirect('/?url=auth/login');
            }
        }
        $this->view('auth/login',['error'=>$this->getFlash('error')]);
    }
    public function logout(){ session_destroy(); $this->redirect('/?url=auth/login'); }
}
