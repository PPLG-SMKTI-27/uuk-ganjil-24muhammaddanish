<?php
// app/models/Parkir.php
require_once __DIR__ . '/../core/Database.php';
class Parkir {
    private $db;
    public function __construct($config) {
        $this->db = Database::getInstance($config['db'])->getConnection();
    }
    public function masuk($plat,$jenis,$petugas_id){
        $s = $this->db->prepare("INSERT INTO parkir (plat_nomor, jenis_kendaraan, jam_masuk, status, petugas_id) VALUES (?,?,NOW(),'parkir',?)");
        return $s->execute([$plat,$jenis,$petugas_id]);
    }
    public function getActive(){ 
        return $this->db->query("SELECT p.*, u.username as petugas FROM parkir p LEFT JOIN users u ON p.petugas_id=u.id WHERE p.status='parkir' ORDER BY p.jam_masuk DESC")->fetchAll();
    }
    public function find($id){
        $s = $this->db->prepare("SELECT p.*, u.username as petugas FROM parkir p LEFT JOIN users u ON p.petugas_id=u.id WHERE p.id=?");
        $s->execute([$id]); return $s->fetch();
    }
    public function keluar($id){
        $row = $this->find($id);
        if (!$row) return false;
        $biaya = $row['jenis_kendaraan'] === 'roda2' ? 5000 : 10000;
        $s = $this->db->prepare("UPDATE parkir SET jam_keluar=NOW(), biaya=?, status='keluar' WHERE id=?");
        return $s->execute([$biaya,$id]);
    }
    public function history($limit=200){
        $s = $this->db->prepare("SELECT p.*, u.username as petugas FROM parkir p LEFT JOIN users u ON p.petugas_id=u.id WHERE p.status='keluar' ORDER BY p.jam_keluar DESC LIMIT ?");
        $s->execute([$limit]); return $s->fetchAll();
    }
}
