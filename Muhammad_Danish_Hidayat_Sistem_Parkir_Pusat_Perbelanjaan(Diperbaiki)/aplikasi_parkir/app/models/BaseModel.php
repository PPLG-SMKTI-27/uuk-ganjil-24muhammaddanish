<?php
namespace app\models;
use app\config\Database;
class BaseModel {
    protected $db;
    public function __construct(){
        $this->db = (new Database())->pdo;
    }
}
