<?php

namespace App\lib;
use \Exception;

class QueryBuilder {
    private $columnKeys; 
    private $columnValues;
    private $columnData; 
    private $queryType; 

    public function __set($prop, $val) {
        if(in_array($prop, $this->columns) && isset($this->queryType)) {
            $addon = end($this->columns) === $prop ? "" : ", ";
            reset($this->columns);

            $val = is_string($val) ? "'{$val}'" : "{$val}";

            $this->columnKeys .= "{$prop}{$addon}";
            $this->columnValues .= "{$val}{$addon}";
            $this->columnData[$prop] = $val;
        }
    }

    public function all() {
        $sql = "SELECT * FROM {$this->tableName};";
        $stmt = conn()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findOne($uniqueColumn, $value) {
        $sql = "SELECT * FROM {$this->tableName} WHERE {$uniqueColumn} = $value";
        $stmt = conn()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if(count($result) === 1)
            return $result[0];
        else throw new Exception("More than one rows were found.");
    }

    public function create() {
        $this->queryType = "create";

        return $this;
    }

    public function update($columnName, $columnValue) {
        $this->queryType = "update";
        $this->columnName = $columnName;
        $this->$columnValue = $columnValue;
        
        return $this;
    }

    public function delete($columnName, $columnValue) {
        $this->queryType = "delete";
        $this->columnName = $columnName;
        $this->$columnValue = $columnValue;

        return $this;
    }

    public function save() {
        $stmt;
        if($this->queryType === "create") {
            $sql = "INSERT INTO {$this->tableName}({$this->columnKeys})
                    VALUES ({$this->columnValues})";
            $stmt = conn()->prepare($sql);
        } else if ($this->queryType === "update") {
            $sql = "UPDATE {$this->tableName}
                    SET ";

            $lastKey = array_key_last($this->columnData);
            foreach($this->columnValues as $prop=>$val) {
                $addon = $prop !== $lastKey ? "," : "";
                $sql .= "{$prop} = {$val}{$addon} ";
            }
            $sql .= "WHERE {$this->columnName} = {$this->columnValue}";
            $stmt = conn()->prepare($sql);
        } else if ($this->queryType === "delete") {
            $sql = "DELETE FROM {$this->tableName}
                    WHERE {$this->columnName} = {$this->columnValue}";
            $stmt = conn()->prepare($sql);
        }
        $stmt->execute();
    }
}