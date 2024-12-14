<?php

class Router {
    private $routes = [];
    public function addRoute(string $path, string $handler) {
        $this->routes[$path] = $handler;
    }

    public function dispatch(string $requestUri) {
        $path = parse_url($requestUri, PHP_URL_PATH);
        $path = rtrim($path, '/');
        $path = $path === '' ? '/' : $path;

        if (isset($this->routes[$path])) {
            [$controllerName, $method] = explode('@', $this->routes[$path]);
            $controllerClass = "src\\controller\\$controllerName";

            if (class_exists($controllerClass)) {
                $controller = new $controllerClass();
                if (method_exists($controller, $method)) {
                    return $controller->$method();
                } else {
                    throw new Exception("Méthode '$method' introuvable dans '$controllerClass'.");
                }
            } else {
                throw new Exception("Classe '$controllerClass' introuvable.");
            }
        }
        throw new Exception("Route non trouvée.");
    }
}
