<?php
use App\lib\Router;

function request() {
    return Router::$requestData;
}