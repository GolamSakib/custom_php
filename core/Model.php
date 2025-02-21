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
        return $stmt->fetch();
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
}