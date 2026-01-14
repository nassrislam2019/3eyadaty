<?php
class Router
{
    private array $routes = [];

    public function add(string $method, string $path, callable $handler, array $roles = []): void
    {
        $this->routes[] = ['method' => strtoupper($method), 'path' => trim($path, '/'), 'handler' => $handler, 'roles' => $roles];
    }

    public function dispatch(string $path, string $method): void
    {
        $path = trim($path, '/');
        foreach ($this->routes as $route) {
            if ($route['method'] === strtoupper($method) && $route['path'] === $path) {
                if (!empty($route['roles'])) {
                    if (!Middleware::auth($route['roles'])) {
                        return;
                    }
                }
                call_user_func($route['handler']);
                return;
            }
        }
        Response::view('errors/404', ['title' => '404']);
    }
}
