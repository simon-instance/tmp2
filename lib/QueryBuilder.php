<?php

namespace App\lib;

class QueryBuilder {
    private $columnValues;

    public function __set($prop, $val) {
        if(in_array($prop, $columns)) {
            $this->columnKeys .= "{$prop}, ";
            $this->columnValues .= "{$val}, ";
            $this->columnData[$prop] = $val;
        }
        else throw Exception("Error: Can't declare a column which doesn't exist (Forgot to add \$columns property to your model?)");
    }

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

    public function update($columnName, $columnValue) {
        $this->queryType = "update";
        $this->columnName = $columnName;
        $this->$columnValue = $columnValue;
        
        return get_class($this);
    }

    public function delete($columnName, $columnValue) {
        $this->queryType = "delete";
        $this->columnName = $columnName;
        $this->$columnValue = $columnValue;

        return get_class($this);
    }

    public function save() {
        if($this->queryType === "create") {
            $sql = "INSERT INTO {$this->tableName}({$this->columnKeys})
                    VALUES ({$this->columnValues})";
            conn()->prepare($sql);
        } else if ($this->queryType === "update") {
            $sql = "UPDATE {$this->tableName}
                    SET ";

            $lastKey = array_key_last($this->columnData);
            foreach($this->columnValues as $prop=>$val) {
                $addon = $prop !== $lastKey ? "," : "";
                $sql .= "{$prop} = {$val}{$addon} ";
            }
            $sql .= "WHERE {$this->columnName} = {$this->columnValue}";
            conn()->prepare($sql);
        } else if ($this->queryType === "delete") {
            $sql = "DELETE FROM {$this->tableName}
                    WHERE {$this->columnName} = {$this->columnValue}";
            conn()->prepare($sql);
        }
    }
}