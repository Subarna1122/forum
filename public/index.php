<?php

require_once __DIR__."/../vendor/autoload.php";

use app\controller\SiteController;
use app\controller\AuthController;
use app\core\Application;

$app = new Application(dirname(__DIR__));

$app->router->get('/', [SiteController::class, 'home']);

$app->router->get('/reply', 'replypage');

$app->router->post('/', [SiteController::class, 'home']);
$app->router->post('/', [SiteController::class, 'handleQuestion']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);







$app->run();

