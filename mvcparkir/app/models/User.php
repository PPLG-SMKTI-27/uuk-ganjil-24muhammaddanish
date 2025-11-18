<?php
// app/models/User.php
require_once __DIR__ . '/../core/Database.php';
class User {
    private $db;
    public function __construct($config) {
        $this->db = Database::getInstance($config['db'])->getConnection();
    }
    public function findByUsername($u){
        $s = $this->db->prepare("SELECT * FROM users WHERE username=? LIMIT 1");
        $s->execute([$u]); return $s->fetch();
    }
    public function all(){
        return $this->db->query("SELECT id,username,role FROM users ORDER BY id DESC")->fetchAll();
    }
    public function find($id){
        $s = $this->db->prepare("SELECT id,username,role FROM users WHERE id=?");
        $s->execute([$id]); return $s->fetch();
    }
    public function create($username,$password,$role){
        $h = password_hash($password, PASSWORD_BCRYPT);
        $s = $this->db->prepare("INSERT INTO users (username,password,role) VALUES (?,?,?)");
        return $s->execute([$username,$h,$role]);
    }
    public function update($id,$username,$password,$role){
        if ($password){
            $h = password_hash($password, PASSWORD_BCRYPT);
            $s = $this->db->prepare("UPDATE users SET username=?, password=?, role=? WHERE id=?");
            return $s->execute([$username,$h,$role,$id]);
        } else {
            $s = $this->db->prepare("UPDATE users SET username=?, role=? WHERE id=?");
            return $s->execute([$username,$role,$id]);
        }
    }
    public function delete($id){
        $s = $this->db->prepare("DELETE FROM users WHERE id=?");
        return $s->execute([$id]);
    }
}
