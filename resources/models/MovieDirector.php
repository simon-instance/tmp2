<?php

namespace App\resources\models;

use App\lib\QueryBuilder;

class MovieDirector extends QueryBuilder {
    public static $tableName = "movieDirectors";
    public static $columns = [
        "movieId",
        "name",
        "surname"
    ];
}