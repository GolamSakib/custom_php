<?php
namespace Core;

use Core\Database;

abstract class Model{
    protected $db;
    protected $table;

    public function __construct(){
        $this->db = Database::getInstance();
    }


    public function find($id){
        $stmt=$this->db->query("SELECT * FROM $this->table WHERE id=$id");
        $result = $stmt->fetch();
        return $result ? $result : null;
    }

public function findBy($column, $value) {
    $sql = "SELECT * FROM {$this->table} WHERE $column = ?";
    $stmt = $this->db->query($sql, [$value]);
    $result = $stmt->fetch();
    return $result ? $result : null;
}


    public function all(){
        $stmt=$this->db->query("SELECT * FROM $this->table");
        return $stmt->fetchAll();
    }

    public function create($data){
        $columns = implode(', ', array_keys($data));
        $values = implode(', ', array_fill(0, count($data), '?'));
        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($values)";
        return $this->db->query($sql, array_values($data));
    }

    public function update($id,$data){
        $sets=[];
        foreach($data as $key => $value){
            $sets[] = "$key = ?";
        };
        $setString = implode(', ', $sets);
        $sql = "UPDATE {$this->table} SET $setString WHERE id = ?";
        $params=array_values($data);
        $params[] = $id;
        return $this->db->query($sql, $params);
    }

    public function delete($id){
        return $this->db->query("DELETE FROM {$this->table} WHERE id = ?", [$id]);

    }

    public function count(){
        $stmt = $this->db->query("SELECT COUNT(*) as count FROM {$this->table}");
        $result = $stmt->fetch();
        return $result['count'];
    }

    public function paginate($page, $perPage){
        $offset = ($page - 1) * $perPage;
        $stmt = $this->db->query("SELECT * FROM {$this->table} LIMIT $offset, $perPage");
        return $stmt->fetchAll();
    }
}
