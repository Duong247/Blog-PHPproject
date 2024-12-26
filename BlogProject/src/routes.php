<?php

use App\Controllers\AuthenticationController;
use App\Controllers\PostController;
use App\Controllers\RegisterController;
use App\Router;
use App\Controllers\UserController;
use App\Controllers\LoginController;


// Usage:
$router = new Router();

// Add routes
$router->addRoute('/\//', [new UserController(), 'index']);
$router->addRoute('/\/user/', [new UserController(), 'userList']);
$router->addRoute('/\/user\/index/', [new UserController(), 'userList']);
//$router->addRoute('/\/user/', [new UserController(), 'index']);
$router->addRoute('/\/user\/show\/(\d+)/', [new UserController(), 'show']);
$router->addRoute('/\/user\/create/', [new UserController(), 'create']);
$router->addRoute('/\/user\/update\/(\d+)/', [new UserController(), 'update']);
$router->addRoute('/\/user\/delete\/(\d+)/', [new UserController(), 'delete']);
$router->addRoute('/\/user\/signin/', [new UserController(), 'signin']);
$router->addRoute('/\/auth\/validate/', [new AuthenticationController(), 'authenticate']);
$router->addRoute('/\/user\/logout/', [new UserController(), 'logout']);
$router->addRoute('/\/user\/verify/', [new UserController(), 'verifyEmail']);


$router->addRoute('/\//', [new PostController(), 'index']);
// $router->addRoute('/\/user/', [new PostController(), 'userList']);
$router->addRoute('/\/posts\/post-list/', [new PostController(), 'postList']);
//$router->addRoute('/\/user/', [new PostController(), 'index']);
$router->addRoute('/\/post\/show\/(\d+)/', [new PostController(), 'show']);
$router->addRoute('/\/post\/create/', [new PostController(), 'create']);
$router->addRoute('/\/post\/update\/(\d+)/', [new PostController(), 'update']);
$router->addRoute('/\/post\/delete\/(\d+)/', [new PostController(), 'delete']);
// $router->addRoute('/\/post\/signin/', [new PostController(), 'signin']);
// $router->addRoute('/\/auth\/validate/', [new AuthenticationController(), 'authenticate']);
// $router->addRoute('/\/post\/logout/', [new PostController(), 'logout']);

$router->addRoute('/\/home/', [new PostController(), 'getRecentPost']);

// $router->addRoute('/\/home/', [new PostController(), 'home']);

$router->addRoute('/\/register\/index/', [new RegisterController(), 'showRegistrationForm']);  // Hiển thị form đăng ký
$router->addRoute('/\/register/', [new RegisterController(), 'register']);
$router->addRoute('/\/register\/verify/', [new RegisterController(), 'verifyEmailForm']);

$router->addRoute('/\/login\/index/', [new LoginController(), 'index']);
