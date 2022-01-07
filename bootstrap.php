<?php
// use App\lib\Router;

db()::init();
session_start();
require_once __DIR__ . "/routes/routes.php";
require_once __DIR__ . "/lib/redirect.php";