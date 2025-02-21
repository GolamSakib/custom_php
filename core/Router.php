<?php
namespace Core;

class Router
{
    private $routes = [];

    public function add($method, $path, $controller, $action)
    {
        $this->routes[] = [
            'method'     => $method,
            'path'       => $path,
            'controller' => $controller,
            'action'     => $action,
        ];
    }

    public function dispatch($requestMethod, $requestUri)
    {
        foreach ($this->routes as $route) {
            if ($route['method'] === $requestMethod && $this->matchPath($route['path'], $requestUri)) {
                $controller = new $route['controller']();
                return $controller->{$route['action']}();
            }
        }
        throw new \Exception('Route not found');
    }

    private function matchPath($routePath, $requestUri)
    {
        $routeSegments = explode('/', trim($routePath, '/'));
        $uriSegments   = explode('/', trim($requestUri, '/'));

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
