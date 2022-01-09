<?php

namespace App\resources\models;
use App\lib\QueryBuilder;

class MovieActor extends QueryBuilder {
    const TABLE_NAME = "movieActors";
    const COLUMNS = [
        "movieId",
        "name",
        "surname"
    ];
}