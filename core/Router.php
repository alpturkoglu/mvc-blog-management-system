<?php

class Router
{
    private array $routes = [];

    public function get(string $path, array $action): void
    {
        $this->routes['GET'][$path] = $action;
    }

    public function post(string $path, array $action): void
    {
        $this->routes['POST'][$path] = $action;
    }

    public function dispatch(string $path): void
    {
        $methodType = $_SERVER['REQUEST_METHOD'];

        if (!isset($this->routes[$methodType][$path])) {
            http_response_code(404);
            echo '404 - Page not found';
            return;
        }

        [$controller, $method] = $this->routes[$methodType][$path];

        require_once __DIR__ . '/../app/Controllers/' . $controller . '.php';

        $controllerInstance = new $controller();
        $controllerInstance->$method();
    }
}