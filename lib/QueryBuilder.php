<?php

namespace App\lib;

class QueryBuilder {
    public function all() {
        $sql = "SELECT * FROM {$this->tableName};";
        $stmt = conn()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function create() {
        $this->queryType = "create";

        return get_class($this);
    }

    public function update() {
        $this->queryType = "update";
        
        return get_class($this);
    }

    public function delete() {
        $this->queryType = "delete";

        return get_class($this);
    }

    // public function save() {
        
    // }
}