<?php
namespace app\models;
class Vehicle extends BaseModel {
    protected $table = 'vehicles';
    public function all($filters = []){
        $sql = "SELECT v.*, u.username as created_by_name FROM vehicles v LEFT JOIN users u ON v.created_by = u.id";
        $where = [];
        $params = [];
        if(!empty($filters['search'])){
            $where[] = "v.plate LIKE ?";
            $params[] = '%' . $filters['search'] . '%';
        }
        if(!empty($filters['type']) && in_array($filters['type'], ['motor','mobil'])){
            $where[] = "v.type = ?";
            $params[] = $filters['type'];
        }
        if(isset($filters['status']) && $filters['status'] !== ''){
            if($filters['status'] === 'active'){
                $where[] = "v.exit_time IS NULL";
            } elseif($filters['status'] === 'exited'){
                $where[] = "v.exit_time IS NOT NULL";
            }
        }
        if($where){
            $sql .= ' WHERE ' . implode(' AND ', $where);
        }
        $sql .= " ORDER BY v.id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function summary($filters = []){
        $where = [];
        $params = [];
        if(!empty($filters['search'])){
            $where[] = "v.plate LIKE ?";
            $params[] = '%' . $filters['search'] . '%';
        }
        if(!empty($filters['type']) && in_array($filters['type'], ['motor','mobil'])){
            $where[] = "v.type = ?";
            $params[] = $filters['type'];
        }
        if(isset($filters['status']) && $filters['status'] !== ''){
            if($filters['status'] === 'active'){
                $where[] = "v.exit_time IS NULL";
            } elseif($filters['status'] === 'exited'){
                $where[] = "v.exit_time IS NOT NULL";
            }
        }
        $sql = "SELECT
            COUNT(*) AS total,
            SUM(CASE WHEN v.exit_time IS NULL THEN 1 ELSE 0 END) AS active,
            SUM(CASE WHEN v.exit_time IS NOT NULL THEN 1 ELSE 0 END) AS exited,
            SUM(CASE WHEN DATE(v.exit_time) = CURDATE() THEN IFNULL(v.fee,0) ELSE 0 END) AS revenue_today
        FROM vehicles v";
        if($where){
            $sql .= ' WHERE ' . implode(' AND ', $where);
        }
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $res = $stmt->fetch();
        return [
            'total' => (int)($res['total'] ?? 0),
            'active' => (int)($res['active'] ?? 0),
            'exited' => (int)($res['exited'] ?? 0),
            'revenue_today' => (int)($res['revenue_today'] ?? 0),
        ];
    }

    public function recentActive($limit = 10){
        $sql = "SELECT v.*, u.username as created_by_name FROM vehicles v LEFT JOIN users u ON v.created_by = u.id WHERE v.exit_time IS NULL ORDER BY v.entry_time DESC LIMIT ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(1, (int)$limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function create($data){
        $stmt = $this->db->prepare("INSERT INTO vehicles (plate,type,entry_time,created_by) VALUES (?, ?, NOW(), ?)");
        return $stmt->execute([$data['plate'],$data['type'],$data['created_by']]);
    }
    public function find($id){
        $stmt = $this->db->prepare("SELECT * FROM vehicles WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    public function update($id,$data){
        $stmt = $this->db->prepare("UPDATE vehicles SET plate=?, type=? WHERE id=?");
        return $stmt->execute([$data['plate'],$data['type'],$id]);
    }
    public function exitVehicle($id){
        $v = $this->find($id);
        if(!$v || $v['exit_time']) return false;
        $fee = ($v['type'] === 'motor') ? 5000 : 10000;
        $stmt = $this->db->prepare("UPDATE vehicles SET exit_time = NOW(), fee = ? WHERE id = ?");
        return $stmt->execute([$fee,$id]);
    }
    public function delete($id){
        $stmt = $this->db->prepare("DELETE FROM vehicles WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
