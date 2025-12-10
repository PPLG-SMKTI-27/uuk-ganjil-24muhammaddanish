<?php
namespace app\models;
class User extends BaseModel {
    protected $table = 'users';
    public function findByUsername($username){
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }
    public function all(){
        return $this->db->query("SELECT * FROM {$this->table} ORDER BY id DESC")->fetchAll();
    }
    public function create($data){
        $stmt = $this->db->prepare("INSERT INTO {$this->table} (username,password,role) VALUES (?,?,?)");
        $hash = password_hash($data['password'], PASSWORD_DEFAULT);
        return $stmt->execute([$data['username'],$hash,$data['role']]);
    }
    public function find($id){
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    public function update($id,$data){
        if(!empty($data['password'])){
            $hash = password_hash($data['password'], PASSWORD_DEFAULT);
            $stmt = $this->db->prepare("UPDATE {$this->table} SET username=?, password=?, role=? WHERE id=?");
            return $stmt->execute([$data['username'],$hash,$data['role'],$id]);
        } else {
            $stmt = $this->db->prepare("UPDATE {$this->table} SET username=?, role=? WHERE id=?");
            return $stmt->execute([$data['username'],$data['role'],$id]);
        }
    }
    public function delete($id){
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id=?");
        return $stmt->execute([$id]);
    }
}
