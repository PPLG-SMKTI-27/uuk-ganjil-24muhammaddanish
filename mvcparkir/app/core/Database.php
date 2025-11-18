<?php
// app/core/Database.php
class Database {
    private static $instance = null;
    private $pdo;

    private function __construct($cfg) {
        $dsn = "mysql:host={$cfg['host']};dbname={$cfg['name']};charset=utf8mb4";
        $this->pdo = new PDO($dsn, $cfg['user'], $cfg['pass'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public static function getInstance($cfg) {
        if (self::$instance === null) self::$instance = new Database($cfg);
        return self::$instance;
    }

    public function getConnection() { return $this->pdo; }
}
