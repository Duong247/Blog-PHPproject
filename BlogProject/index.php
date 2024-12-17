<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Controller\UserController;
use App\Router;


require __DIR__. '/src/routes.php';
$uri = $_SERVER['REQUEST_URI'];

$router->match($uri);

/*
// Match URIs
$uri = '/user';
$uri = '/user/index';
$uri = '/user/show/1';
$uri = '/';
$uri = '/user/create';
$uri = '/user/update/2';
*/