<?php
namespace Core;

class Router
{
    private $routes = [];

    private $middleware = [];

    public function add($method, $path, $controller, $action, $middleware = [])
    {
        $this->routes[] = [
            'method'     => $method,
            'path'       => $path,
            'controller' => $controller,
            'action'     => $action,
            'middleware' => $middleware,
        ];
    }

    public function addMiddleware($middleware)
    {
        $this->middleware[] = $middleware;
    }

public function dispatch($requestMethod, $requestUri)
{
    $queryParams = [];
    if (strpos($requestUri, '?') !== false) {
        list($requestUri, $queryString) = explode('?', $requestUri);
        parse_str($queryString, $queryParams);
    }

    foreach ($this->routes as $route) {
        if ($route['method'] === $requestMethod && $this->matchPath($route['path'], $requestUri)) {
            foreach ($route['middleware'] as $middleware) {
                (new $middleware())->handle();
            }

            foreach ($this->middleware as $middleware) {
                (new $middleware())->handle();
            }

            $controller = new $route['controller']();
            echo $controller->{$route['action']}(...array_values($queryParams));
        }
    }
}

private function matchPath($routePath, $requestUri)
{
    // Special handling for root path
    if ($routePath === '/') {
        return $requestUri === '/' || $requestUri === '';
    }

    $routeSegments = explode('/', trim($routePath, '/'));
    $uriSegments = explode('/', trim($requestUri, '/'));

    if (count($routeSegments) !== count($uriSegments)) {
        return false;
    }

    foreach ($routeSegments as $key => $segment) {
        if(empty($segment)) continue;

        if ($segment[0] === ':') {
            $_GET[substr($segment, 1)] = $uriSegments[$key];
            continue;
        }
        
        if ($segment !== $uriSegments[$key]) {
            return false;
        }
    }
    
    return true;
}
}
