<?php

use App\lib\Router;

$router = new Router();

foreach(Router::$routes as $key=>$route) {
    if($router->atCurrentRoute($key, $route)) $router->execRoute($route);
}