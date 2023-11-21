<?php

class Router
{
    private static $routes = [];

    public static function addRoute($uri, $handler)
    {
        self::$routes[$uri] = $handler;
    }

    public static function handleRequest($uri)
    {
        if (array_key_exists($uri, self::$routes)) {
            list($controllerName, $methodName) = explode('@', self::$routes[$uri]);

            // Autoload atau require file controller jika belum dilakukan sebelumnya
            require_once '../contoller/' . $controllerName . '.php';

            // Buat instance dari controller
            $controller = new $controllerName();

            // Panggil metode yang sesuai
            $controller->$methodName();
        } else {
            // Tampilkan pesan 404 jika rute tidak ditemukan
            header("HTTP/1.0 404 Not Found");
            echo '404 Not Found';
        }
    }
}
