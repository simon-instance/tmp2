<?php

namespace App\resources\models;

use App\lib\QueryBuilder;

class MovieDirector extends QueryBuilder {
    const TABLE_NAME = "movieDirectors";
    const COLUMNS = [
        "movieId",
        "name",
        "surname"
    ];
}