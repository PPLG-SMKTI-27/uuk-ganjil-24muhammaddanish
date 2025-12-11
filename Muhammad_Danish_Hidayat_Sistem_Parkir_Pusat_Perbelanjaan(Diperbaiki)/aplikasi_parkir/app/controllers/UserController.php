<?php
namespace app\controllers;
use app\models\User;
class UserController {
    private $m;
    public function __construct(){ $this->m = new User(); }
    public function handle($path){
        if(!isset($_SESSION['user'])) { header('Location: ' . BASE_URL . 'login'); exit; }
        if($_SESSION['user']['role'] !== 'admin'){ echo 'Access denied'; exit; }
        if($path === 'users' ){
            $users = $this->m->all();
            require __DIR__ . '/../views/users/index.php';
        } elseif($path === 'users/create' && $_SERVER['REQUEST_METHOD']==='GET'){
            require __DIR__ . '/../views/users/create.php';
        } elseif($path === 'users/store' && $_SERVER['REQUEST_METHOD']==='POST'){
            $this->m->create($_POST);
            header('Location: ' . BASE_URL . 'users');
        } elseif($path === 'users/edit' && isset($_GET['id'])){
            $user = $this->m->find($_GET['id']);
            require __DIR__ . '/../views/users/edit.php';
        } elseif($path === 'users/update' && $_SERVER['REQUEST_METHOD']==='POST' && isset($_GET['id'])){
            $this->m->update($_GET['id'], $_POST);
            header('Location: ' . BASE_URL . 'users');
        } elseif($path === 'users/change_role' && $_SERVER['REQUEST_METHOD']==='POST' && isset($_GET['id'])){
            // only admin allowed (UserController already checks admin at top)
            $newRole = $_POST['role'] ?? '';
            if(!in_array($newRole, ['admin','petugas'])){
                $_SESSION['error'] = 'Role tidak valid';
                header('Location: ' . BASE_URL . 'users'); exit;
            }
            // update only role without touching password/username
            $this->m->update($_GET['id'], ['username' => $this->m->find($_GET['id'])['username'], 'role' => $newRole]);
            $_SESSION['success'] = 'Role pengguna berhasil diubah.';
            header('Location: ' . BASE_URL . 'users');
        } elseif($path === 'users/delete' && isset($_GET['id'])){
            // prevent admin from deleting themselves
            $deleteId = (int) $_GET['id'];
            $currentId = $_SESSION['user']['id'] ?? 0;
            if ($deleteId === $currentId) {
                $_SESSION['error'] = 'Tidak dapat menghapus akun Anda sendiri.';
                header('Location: ' . BASE_URL . 'users');
                exit;
            }
            $this->m->delete($deleteId);
            header('Location: ' . BASE_URL . 'users');
        } else {
            echo '404 users';
        }
    }
}
