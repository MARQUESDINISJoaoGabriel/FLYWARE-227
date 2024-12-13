<?php
class Router {
    private $routes = [];

    public function add($uri, $controller) {
        $this->routes[$uri] = $controller;
    }

    public function dispatch($uri) {
        if (array_key_exists($uri, $this->routes)) {
            $controller = $this->routes[$uri];
            return new $controller();
        } else {
            header("HTTP/1.0 404 Not Found");
            include 'views/404.php';
            exit();
        }
    }
}
