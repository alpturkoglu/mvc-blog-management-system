<?php

require_once dirname(__DIR__) . '/config/app.php';
require_once dirname(__DIR__) . '/config/database.php';
require_once dirname(__DIR__) . '/core/Router.php';

$router = new Router();

require_once dirname(__DIR__) . '/routes/web.php';

$route = $_GET['url'] ?? '/';
$route = '/' . trim($route, '/');

$router->dispatch($route);