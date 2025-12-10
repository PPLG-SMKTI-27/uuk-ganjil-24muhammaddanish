<?php
namespace app\controllers;

class AdminController
{
    public function audit()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user']) || (($_SESSION['user']['role'] ?? '') !== 'admin')) {
            http_response_code(403);
            echo "Akses ditolak: hanya admin.";
            return;
        }

        $logFile = __DIR__ . '/../logs/audit.log';
        $entries = [];
        if (file_exists($logFile)) {
            $lines = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $lines = array_reverse($lines);
            $limit = isset($_GET['lines']) ? (int)$_GET['lines'] : 200;
            $lines = array_slice($lines, 0, $limit);
            foreach ($lines as $line) {
                $parts = explode("\t", $line);
                // Expected format: timestamp\taction\tuser\tvehicleId
                $entries[] = [
                    'timestamp' => $parts[0] ?? '',
                    'action' => $parts[1] ?? '',
                    'user' => $parts[2] ?? '',
                    'vehicle' => $parts[3] ?? ''
                ];
            }
        }

        // CSV export
        if (isset($_GET['export']) && $_GET['export'] === 'csv') {
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="audit_log.csv"');
            $out = fopen('php://output', 'w');
            fputcsv($out, ['timestamp', 'action', 'user', 'vehicle']);
            foreach ($entries as $e) {
                fputcsv($out, [$e['timestamp'], $e['action'], $e['user'], $e['vehicle']]);
            }
            fclose($out);
            return;
        }

        require __DIR__ . '/../views/admin/audit.php';
    }
}
