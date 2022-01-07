<?php

namespace App\resources\models;
use App\lib\QueryBuilder;

class Movie extends QueryBuilder {
    public static $tableName = "movies";
    public static $columns = [
        "title",
        "genre",
        "duration",
        "releaseYear"
    ];
}