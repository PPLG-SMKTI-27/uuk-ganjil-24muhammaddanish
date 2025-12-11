<?php
namespace app\controllers;
use app\models\Vehicle;
class DashboardController {
    public function index(){
        if(!isset($_SESSION['user'])) { header('Location: ' . BASE_URL . 'login'); exit; }
        $m = new Vehicle();
        $filters = [];
        // dashboard shows active vehicles and summaries by default
        $vehicles = $m->recentActive(10);
        $summaryActive = $m->summary(['status' => 'active']);
        $summaryAll = $m->summary([]);
        require __DIR__ . '/../views/dashboard/index.php';
    }
}
