<?php
namespace App\lib;

class Router {
    public static $routes = [];

    public function __get($prop) {
        if($prop === "routes") return self::$routes;
    }

    public static function get($url, $controllerData) {
        self::saveRoute($url, $controllerData);
        return new self();
    }

    public function name($routeName = "") {
        // End is used to set the pointer to the last array value
        end(self::$routes);
        // Get the key value of the pointer
        $key = key(self::$routes);
        self::$routes[$key]["name"] = $routeName;
    }

    private static function saveRoute($url = "", $controllerData = []) {
        self::$routes[$url]["class"] = "App\\resources\\controllers\\" . $controllerData[0];
        self::$routes[$url]["function"] = $controllerData[1];
    }

    public function execRoute(array $routeData) {
        (new $routeData["class"])->{$routeData["function"]}();
    }
}