<?php
namespace app\controllers;
use app\models\Vehicle;
class VehicleController {
    private $m;
    public function __construct(){ $this->m = new Vehicle(); }
    public function handle($path){
        if(!isset($_SESSION['user'])) { header('Location: ' . BASE_URL . 'login'); exit; }
        if($path === 'vehicles'){
            $filters = [
                'search' => $_GET['search'] ?? null,
                'type' => $_GET['type'] ?? null,
                'status' => $_GET['status'] ?? null,
            ];
            $vehicles = $this->m->all($filters);
            $summary = $this->m->summary($filters);
            require __DIR__ . '/../views/vehicles/index.php';
        } elseif($path === 'vehicles/create' && $_SERVER['REQUEST_METHOD']==='GET'){
            // only petugas or admin can register new vehicles
            if(!in_array($_SESSION['user']['role'], ['admin','petugas'])){
                $_SESSION['error'] = 'Akses ditolak: hanya petugas atau admin dapat menambah kendaraan.';
                header('Location: ' . BASE_URL . 'vehicles'); exit;
            }
            require __DIR__ . '/../views/vehicles/create.php';
        } elseif($path === 'vehicles/store' && $_SERVER['REQUEST_METHOD']==='POST'){
            // ensure only petugas or admin can store
            if(!in_array($_SESSION['user']['role'], ['admin','petugas'])){
                $_SESSION['error'] = 'Akses ditolak: hanya petugas atau admin dapat menyimpan kendaraan.';
                header('Location: ' . BASE_URL . 'vehicles'); exit;
            }
            $_POST['created_by'] = $_SESSION['user']['id'];
            $this->m->create($_POST);
            header('Location: ' . BASE_URL . 'vehicles');
        } elseif($path === 'vehicles/edit' && isset($_GET['id'])){
            $vehicle = $this->m->find($_GET['id']);
            // only admin or the creator can edit
            if($_SESSION['user']['role'] !== 'admin' && $_SESSION['user']['id'] !== $vehicle['created_by']){
                $_SESSION['error'] = 'Akses ditolak: hanya admin atau petugas yang mendaftarkan kendaraan yang dapat mengedit.';
                header('Location: ' . BASE_URL . 'vehicles'); exit;
            }
            require __DIR__ . '/../views/vehicles/edit.php';
        } elseif($path === 'vehicles/update' && $_SERVER['REQUEST_METHOD']==='POST' && isset($_GET['id'])){
            $vehicle = $this->m->find($_GET['id']);
            if($_SESSION['user']['role'] !== 'admin' && $_SESSION['user']['id'] !== $vehicle['created_by']){
                $_SESSION['error'] = 'Akses ditolak: hanya admin atau petugas yang mendaftarkan kendaraan yang dapat mengedit.';
                header('Location: ' . BASE_URL . 'vehicles'); exit;
            }
            $this->m->update($_GET['id'], $_POST);
            // audit update
            $this->audit("update", $_SESSION['user']['id'], $_GET['id']);
            header('Location: ' . BASE_URL . 'vehicles');
        } elseif($path === 'vehicles/exit' && isset($_GET['id'])){
            // only petugas or admin can mark exit
            if(!in_array($_SESSION['user']['role'], ['admin','petugas'])){
                $_SESSION['error'] = 'Akses ditolak: hanya petugas atau admin dapat menandai kendaraan keluar.';
                header('Location: ' . BASE_URL . 'vehicles'); exit;
            }
            // prevent exit if already exited
            $v = $this->m->find($_GET['id']);
            if(!$v){ $_SESSION['error'] = 'Kendaraan tidak ditemukan.'; header('Location: ' . BASE_URL . 'vehicles'); exit; }
            if($v['exit_time']){ $_SESSION['error'] = 'Kendaraan sudah keluar.'; header('Location: ' . BASE_URL . 'vehicles'); exit; }
            $this->m->exitVehicle($_GET['id']);
            $this->audit("exit", $_SESSION['user']['id'], $_GET['id']);
            header('Location: ' . BASE_URL . 'vehicles');
        } elseif($path === 'vehicles/delete' && isset($_GET['id'])){
            // only admin may delete vehicle records
            if(!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin'){
                $_SESSION['error'] = 'Akses ditolak: hanya admin yang dapat menghapus kendaraan.';
                header('Location: ' . BASE_URL . 'vehicles');
                exit;
            }
            $this->m->delete($_GET['id']);
            $this->audit("delete", $_SESSION['user']['id'], $_GET['id']);
            header('Location: ' . BASE_URL . 'vehicles');
        } else {
            echo '404 vehicles';
        }
    }

    private function audit($action, $userId, $vehicleId){
        $logDir = __DIR__ . '/../logs';
        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }
        $file = $logDir . '/audit.log';
        $line = date('Y-m-d H:i:s') . "\t" . strtoupper($action) . "\tuser:" . $userId . "\tvehicle:" . $vehicleId;
        $res = file_put_contents($file, $line . PHP_EOL, FILE_APPEND | LOCK_EX);
        if ($res === false) {
            error_log("[AUDIT] Failed to write to $file: $line");
        }
    }
}
