<?php

namespace App\resources\models;
use App\lib\QueryBuilder;

class Movie extends QueryBuilder {
    const TABLE_NAME = "movies";
    const COLUMNS = [
        "title",
        "genre",
        "duration",
        "releaseYear"
    ];
}