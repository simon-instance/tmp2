<?php

namespace App\resources\models;

use App\lib\QueryBuilder;

class User extends QueryBuilder {
    protected $tableName = "users";
}