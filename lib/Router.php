<?php
namespace App\lib;

class Router {
    public static $routes = [];
    public static $requestData;

    public static function get($url, $controllerData) {
        self::saveRoute($url, $controllerData, "GET");
        return new self();
    }

    public static function post($url, $controllerData) {
        self::saveRoute($url, $controllerData, "POST");
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
        preg_match_all("/\{[A-Za-z0-9]+\}/", $url, $matches);

        return $matches[0];
    }

    private static function getUrlMatchPatterns(String $url): Array {
        $matchUri = str_replace("/", "\/", $url);
        $matchUriParams = $matchUri;
        $matchPattern = "[A-Za-z0-9]+";
        $paramsMatchPattern = "([A-Za-z0-9]+)";
        foreach(self::$routes[$url]["params"] as $key=>$param) {
            $matchUri = str_replace($param, $matchPattern, $matchUri);
            $matchUriParams = str_replace($param, $paramsMatchPattern, $matchUriParams);
        }
        return [$matchUri, $matchUriParams];
    }

    private static function saveRoute($url = "", $controllerData = [], $method = "get") {
        self::$routes[$url]["params"] = self::getUrlParams($url);
        $matchPatterns = self::getUrlMatchPatterns($url);
        self::$routes[$url]["matchPattern"] = $matchPatterns[0];
        self::$routes[$url]["paramsMatchPattern"] = $matchPatterns[1];
        self::$routes[$url]["class"] = "App\\resources\\controllers\\" . $controllerData[0];
        self::$routes[$url]["function"] = $controllerData[1];
        self::$routes[$url]["method"] = $method;
    }

    public function execRoute(array $routeData) {
        (new $routeData["class"])->{$routeData["function"]}();
    }

    // url = key of route
    public function atCurrentRoute($url, $route) {
        $matches = [];
        preg_match("/^{$route['matchPattern']}$/", $_SERVER["REQUEST_URI"], $matches);

        if(in_array($url, array_keys(self::$routes)) && count($matches) === 1) {
            if($route["method"] != $_SERVER["REQUEST_METHOD"])
                throw new \Exception("Wrong request method, for this route you need the {$route['method']} method.");

            return true;
        } else if(!in_array($url, array_keys(self::$routes)) && count($matches) === 1) {
            $tmp = [];
            preg_match("/{$route["paramsMatchPattern"]}/", $_SERVER["REQUEST_URI"], $tmp);
            unset($tmp[0]);
            $tmp = array_values($tmp);
            foreach($route["params"] as $key=>$param) {
                $newParams = preg_replace("/[{}]/", "", $route["params"]);
                self::$requestData[$newParams[$key]] = $tmp[$key];
            }
            self::$requestData = (object)self::$requestData;
            return true;
        }
        return false;
    }
}