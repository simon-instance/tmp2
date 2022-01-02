<?php
use App\lib\Router;

function request() {
    return Router::$requestData;
}

function redirect($routeName) {
    return Router::route($routeName);
}

function view($viewPath = "") {
    require_once __DIR__ . "/../../views/{$viewPath}.php";
}