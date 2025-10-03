<?php
namespace vendor\frame;
use PDO;


class Model {
    public $table = "category";
    public $offset;
    public $limit;
    public $db;

    public function __construct() {
        $db = new Connection();
        $this->db = $db->getConnection();
        $request = new Request();
        $this->offset = ($request->page - 1) * $request->limit;
        $this->limit = $request->limit;
    }

    public function tableName() {
        return $this->table;
    }

    public function getList() {
        $sql = "SELECT * FROM {$this->tableName()} LIMIT :limit OFFSET :offset";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $this->limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $this->offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }



    public function getById($id) {
        $sql = "SELECT * FROM {$this->tableName()} WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getCountPage() {
        $sql = "SELECT COUNT(*) AS total FROM {$this->tableName()}";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        return ceil($row->total / $this->limit);
    }

    public function save($data) {
        $columns = array_keys($data);
        $placeholders = array_map(fn($col) => ":$col", $columns);

        $sql = "INSERT INTO {$this->tableName()} (" . implode(", ", $columns) . ")
                VALUES (" . implode(", ", $placeholders) . ")";
                
        $stmt = $this->db->prepare($sql);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        $stmt->execute();

        return  $this->db->lastInsertId();
    }
    public function update($id, $data) {
        $cols = [];
        foreach ($data as $key => $value) {
            $cols[] = "$key = :$key";
        }
        $cols = implode(", ", $cols);

        $sql = "UPDATE {$this->tableName()} SET {$cols} WHERE id = :id";
        $stmt = $this->db->prepare($sql);

        // qiymatlarni bog‘lash
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function delete($id) {
        $sql = "DELETE  FROM {$this->tableName()} WHERE id = {$id}";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
    }
}

