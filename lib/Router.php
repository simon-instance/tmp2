<?php
namespace App\lib;

class Router {
    public static $routes = [];

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

    private static function getUrlParams(String $url): array {
        $matches;
        preg_match_all("/\{[A-Za-z0-9]+\}/", $url, $matches, PREG_OFFSET_CAPTURE);

        return $matches[0];
    }

    private static function getUrlMatchPattern(String $url): String {
        $matchUri = str_replace("/", "\/", $url);
        $matchPattern = "[A-Za-z0-9]+";
        foreach(self::$routes[$url]["params"] as $key=>$param) {
            $matchUri = str_replace($param[0], $matchPattern, $matchUri);
        }
        return $matchUri;
    }

    private static function saveRoute($url = "", $controllerData = []) {
        self::$routes[$url]["params"] = self::getUrlParams($url);
        self::$routes[$url]["matchPattern"] = self::getUrlMatchPattern($url);
        self::$routes[$url]["class"] = "App\\resources\\controllers\\" . $controllerData[0];
        self::$routes[$url]["function"] = $controllerData[1];
    }

    public function execRoute(array $routeData) {
        (new $routeData["class"])->{$routeData["function"]}();
    }

    // url = key of route
    public function atCurrentRoute($url, $route) {
        $matches = [];
        preg_match("/^{$route['matchPattern']}$/", $_SERVER["REQUEST_URI"], $matches);
        if(count($matches) === 1) return true;
        return false;
    }
}