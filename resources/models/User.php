<?php

namespace App\resources\models;

use App\lib\QueryBuilder;

class User extends QueryBuilder {
    const TABLE_NAME = "users";
    const COLUMNS = [
        "subscriptionId",
        "name",
        "surname",
        "country",
        "birthyear",
        "bankAccNo",
        "username",
        "password"
    ];
}