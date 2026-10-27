<?php

require_once __DIR__ . '/../app/Controllers/HomeController.php';
require_once __DIR__ . '/../app/Controllers/AuthController.php';
require_once __DIR__ . '/../app/Controllers/PostController.php';
require_once __DIR__ . '/../app/Controllers/DashboardController.php';
require_once __DIR__ . '/../app/Controllers/AdminController.php';
require_once __DIR__ . '/../app/Controllers/ProfileController.php';
require_once __DIR__ . '/../app/Controllers/CategoryController.php';
require_once __DIR__ . '/../app/Controllers/CommentController.php';

$router->get('/', [HomeController::class, 'index']);

$router->get('/register', [AuthController::class, 'showRegister']);
$router->post('/register', [AuthController::class, 'register']);

$router->get('/login', [AuthController::class, 'showLogin']);
$router->post('/login', [AuthController::class, 'login']);

$router->get('/logout', [AuthController::class, 'logout']);

$router->get('/dashboard', [DashboardController::class, 'index']);
$router->get('/admin', [AdminController::class, 'index']);

$router->get('/profile', [ProfileController::class, 'index']);

$router->get(
    '/profile/change-password',
    [ProfileController::class, 'changePassword']
);

$router->post(
    '/profile/update-password',
    [ProfileController::class, 'updatePassword']
);

$router->get('/posts', [PostController::class, 'index']);
$router->get('/posts/show', [PostController::class, 'show']);
$router->get('/posts/create', [PostController::class, 'create']);
$router->post('/posts/store', [PostController::class, 'store']);
$router->get('/posts/edit', [PostController::class, 'edit']);
$router->post('/posts/update', [PostController::class, 'update']);
$router->get('/posts/delete', [PostController::class, 'delete']);

$router->post('/comments/store', [CommentController::class, 'store']);

$router->get('/categories', [CategoryController::class, 'index']);
$router->get('/categories/create', [CategoryController::class, 'create']);
$router->post('/categories/store', [CategoryController::class, 'store']);
$router->get('/categories/delete', [CategoryController::class, 'delete']);