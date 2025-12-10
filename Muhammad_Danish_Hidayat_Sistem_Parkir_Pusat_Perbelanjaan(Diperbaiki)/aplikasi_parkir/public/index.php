<?php
session_start();

spl_autoload_register(function($class){
    $class = str_replace('\\', '/', $class);
    $file = __DIR__ . '/../' . $class . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
$path = trim(substr($uri, strlen($base)), '/');

define('BASE_URL', $base . '/');

if ($path === '') {
    $path = 'dashboard';
}

switch (true) {

    case $path === 'login' && $_SERVER['REQUEST_METHOD'] === 'GET':
        (new app\controllers\AuthController())->showLogin();
        break;

    case $path === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST':
        (new app\controllers\AuthController())->login();
        break;

    case $path === 'logout':
        (new app\controllers\AuthController())->logout();
        break;

    case strpos($path, 'users') === 0:
        (new app\controllers\UserController())->handle($path);
        break;

    case strpos($path, 'vehicles') === 0:
        (new app\controllers\VehicleController())->handle($path);
        break;

    case $path === 'admin/audit':
        (new app\controllers\AdminController())->audit();
        break;

    case $path === 'dashboard':
        (new app\controllers\DashboardController())->index();
        break;

    default:
        http_response_code(404);
        echo "<h1>404 — Halaman Tidak Ditemukan</h1>";
        break;
}