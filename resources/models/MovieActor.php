<?php

namespace App\resources\models;
use App\lib\QueryBuilder;

class MovieActor extends QueryBuilder {
    public static $tableName = "movieActors";
    public static $columns = [
        "movieId",
        "name",
        "surname"
    ];
}