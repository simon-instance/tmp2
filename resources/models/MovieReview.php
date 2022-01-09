<?php

namespace App\resources\models;

use App\lib\QueryBuilder;

class MovieReview extends QueryBuilder {
    const TABLE_NAME = "movieReviews";
    const COLUMNS = [
        "userId",
        "movieId",
        "content",
        "rating"
    ];
}