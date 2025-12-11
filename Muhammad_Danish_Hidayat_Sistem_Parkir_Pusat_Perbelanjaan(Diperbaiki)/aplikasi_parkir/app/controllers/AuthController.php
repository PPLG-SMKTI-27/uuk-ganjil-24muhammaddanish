<?php
namespace app\controllers;
use app\models\User;
class AuthController {
    public function showLogin(){
        require __DIR__ . '/../views/auth/login.php';
    }
    public function showRegister(){
        require __DIR__ . '/../views/auth/register.php';
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
    public function register(){
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        $password2 = $_POST['password2'] ?? '';
        if($username === '' || $password === ''){
            $_SESSION['error'] = 'Username dan password wajib diisi.';
            header('Location: ' . BASE_URL . 'register'); exit;
        }
        if($password !== $password2){
            $_SESSION['error'] = 'Konfirmasi password tidak cocok.';
            header('Location: ' . BASE_URL . 'register'); exit;
        }
        $m = new User();
        if($m->findByUsername($username)){
            $_SESSION['error'] = 'Username sudah dipakai.';
            header('Location: ' . BASE_URL . 'register'); exit;
        }
        // default role for self-registered users
        $m->create(['username' => $username, 'password' => $password, 'role' => 'petugas']);
        $_SESSION['success'] = 'Registrasi berhasil. Silakan login.';
        header('Location: ' . BASE_URL . 'login'); exit;
    }
    public function logout(){
        session_destroy();
        header('Location: ' . BASE_URL . 'login');
    }
}
