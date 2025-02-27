<?php

require_once '../vendor/autoload.php';
use Core\Model;
use Core\Router;
$router = new Router;



// Define routes
use Core\Middleware\AuthMiddleware;

$router->add('GET', '/', 'App\Controllers\EventController', 'index', [AuthMiddleware::class]);
$router->add('GET', '/login', 'App\Controllers\AuthController', 'loginForm');
$router->add('POST', '/login', 'App\Controllers\AuthController', 'login');
$router->add('GET', '/register', 'App\Controllers\AuthController', 'registerForm');
$router->add('POST', '/register', 'App\Controllers\AuthController', 'register');
$router->add('GET', '/events', 'App\Controllers\EventController', 'index', [AuthMiddleware::class]);
$router->add('GET', '/events/create', 'App\Controllers\EventController', 'create', [AuthMiddleware::class]);
$router->add('POST', '/events', 'App\Controllers\EventController', 'store', [AuthMiddleware::class]);
$router->add('GET', '/events/:id', 'App\Controllers\EventController', 'show', [AuthMiddleware::class]);
$router->add('POST', '/events/:id/register', 'App\Controllers\AttendeeController', 'register', [AuthMiddleware::class]);

try {
    $router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
} catch (\Exception $e) {
    echo $e->getMessage();
    http_response_code(404);
    echo '404 Not Found';
}
