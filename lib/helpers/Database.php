<?php
use App\lib\Database;

function conn() {
    return Database::getInstance()->conn;
}

function db() {
    return Database::getInstance();
}