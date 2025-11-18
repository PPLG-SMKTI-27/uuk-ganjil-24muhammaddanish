<?php
// app/core/Controller.php
class Controller {
    protected $config;
    protected $baseUrl;
    public function __construct($config = []) {
        $this->config = $config;
        $this->baseUrl = $config['base_url'] ?? '';
        if (session_status() === PHP_SESSION_NONE) session_start();
    }
    protected function view($path, $data = []) {
        extract($data, EXTR_SKIP);
        require __DIR__ . "/../views/layouts/header.php";
        require __DIR__ . "/../views/layouts/navbar.php";
        require __DIR__ . "/../views/{$path}.php";
        require __DIR__ . "/../views/layouts/footer.php";
    }
    protected function redirect($path) {
        header("Location: {$this->baseUrl}{$path}");
        exit;
    }
    protected function requireLogin() {
        if (empty($_SESSION['user'])) $this->redirect('/?url=auth/login');
    }
    protected function requireRole($roles = []) {
        $this->requireLogin();
        if (!in_array($_SESSION['user']['role'], (array)$roles)) {
            echo "<h3>403 Forbidden</h3>";
            exit;
        }
    }
    protected function setFlash($k,$v){ $_SESSION['flash'][$k]=$v; }
    protected function getFlash($k){ $v = $_SESSION['flash'][$k] ?? null; unset($_SESSION['flash'][$k]); return $v; }
}
