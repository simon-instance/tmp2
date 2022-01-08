<?php

namespace App\resources\models;

use App\lib\QueryBuilder;

class MovieReview extends QueryBuilder {
    public static $tableName = "movieReviews";
    public static $columns = [
        "userId",
        "movieId",
        "content",
        "rating"
    ];
}