<?php

namespace Core;

class Router
{
    protected array $routes = [];
    protected array $middleware = [];

    public function get(string $uri, string $action, array $middleware = []): void
    {
        $this->addRoute('GET', $uri, $action, $middleware);
    }

    public function post(string $uri, string $action, array $middleware = []): void
    {
        $this->addRoute('POST', $uri, $action, $middleware);
    }

    public function put(string $uri, string $action, array $middleware = []): void
    {
        $this->addRoute('PUT', $uri, $action, $middleware);
    }

    public function delete(string $uri, string $action, array $middleware = []): void
    {
        $this->addRoute('DELETE', $uri, $action, $middleware);
    }

    protected function addRoute(string $method, string $uri, string $action, array $middleware): void
    {
        $pattern = preg_replace('/\{([a-zA-Z]+)\}/', '(?P<$1>[a-zA-Z0-9_-]+)', $uri);
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'pattern' => '#^' . $pattern . '$#',
            'action' => $action,
            'middleware' => $middleware
        ];
    }

    protected array $globalMiddleware = [];

    public function addGlobalMiddleware(string $middleware): void
    {
        $this->globalMiddleware[] = $middleware;
    }

    public function dispatch(string $method, string $uri): void
    {
        $uri = parse_url($uri, PHP_URL_PATH);
        $uri = rtrim($uri, '/') ?: '/';

        // Run global middleware for all routes
        foreach ($this->globalMiddleware as $mw) {
            $mClass = $mw;
            if (class_exists($mClass)) {
                $mInstance = new $mClass();
                $mInstance->handle();
            }
        }

        foreach ($this->routes as $route) {
            if ($route['method'] !== $method) continue;

            if (preg_match($route['pattern'], $uri, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

                // Run route-specific middleware
                foreach ($route['middleware'] as $mw) {
                    $mClass = $mw;
                    if (class_exists($mClass)) {
                        $mInstance = new $mClass();
                        $mInstance->handle();
                    }
                }

                $this->callAction($route['action'], $params);
                return;
            }
        }

        $this->notFound();
    }

    protected function callAction(string $action, array $params): void
    {
        [$controller, $method] = explode('@', $action);

        if (!str_starts_with($controller, 'App\\Controllers\\')) {
            $controller = 'App\\Controllers\\' . $controller;
        }

        if (!class_exists($controller)) {
            throw new \Exception("Controller {$controller} not found");
        }

        $instance = new $controller();
        $request = new Request();

        if (!method_exists($instance, $method)) {
            throw new \Exception("Method {$method} not found in {$controller}");
        }

        // Build args: Request first, then URL params in order
        $args = [$request];
        $refMethod = new \ReflectionMethod($instance, $method);
        $refParams = $refMethod->getParameters();

        foreach ($refParams as $i => $refParam) {
            if ($i === 0) continue; // Request already added
            $paramName = $refParam->getName();
            $args[] = $params[$paramName] ?? null;
        }

        call_user_func_array([$instance, $method], $args);
    }

    protected function notFound(): void
    {
        http_response_code(404);
        echo View::render('Frontend.errors.404', ['title' => 'Page Not Found']);
        exit;
    }
}
