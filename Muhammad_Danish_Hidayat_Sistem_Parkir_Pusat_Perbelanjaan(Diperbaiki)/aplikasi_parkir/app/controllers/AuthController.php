<?php
namespace app\controllers;
use app\models\User;
class AuthController {
    public function showLogin(){
        require __DIR__ . '/../views/auth/login.php';
    }
    public function login(){
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $m = new User();
        $user = $m->findByUsername($username);
        if(!$user){
            $_SESSION['error'] = 'User tidak ditemukan';
            header('Location: ' . BASE_URL . 'login'); exit;
        }
        if(password_verify($password, $user['password']) || hash('sha256',$password) === $user['password']){
            unset($user['password']);
            $_SESSION['user'] = $user;
            header('Location: ' . BASE_URL . 'dashboard'); exit;
        } else {
            $_SESSION['error'] = 'Login gagal';
            header('Location: ' . BASE_URL . 'login'); exit;
        }
    }
    public function logout(){
        session_destroy();
        header('Location: ' . BASE_URL . 'login');
    }
}
