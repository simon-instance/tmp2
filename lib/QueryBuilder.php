<?php

namespace App\lib;

class QueryBuilder {
    public function query(string $query = "", array $queryParams = []): void {
        $sql = $query;
        $this->intermediateStmt = conn()->prepare($sql);
        $this->intermediateStmt->execute($queryParams);
    }

    public function get(): array {
        return $this->intermediateStmt->fetchAll();
    }
    
}