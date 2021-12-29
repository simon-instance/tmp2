<?php

use App\lib\Router;

$router = new Router();

foreach(Router::$routes as $key=>$route) {
    if($key === $_SERVER["REQUEST_URI"]) $router->execRoute($route);
}