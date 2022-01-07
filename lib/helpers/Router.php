<?php
use App\lib\Router;
use App\lib\SessionHandler;

function request() {
    return Router::$requestData;
}

function redirect($routeName) {
    return Router::route($routeName);
}

function view($viewPath = "", $params = []) {
    foreach($params as $key=>$param) {
        $_SESSION[$key] = $param;
    }
    require_once __DIR__ . "/../../views/{$viewPath}.php";
}

function session() {
    return new SessionHandler;
}