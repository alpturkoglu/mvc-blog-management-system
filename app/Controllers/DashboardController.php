<?php

require_once __DIR__ . '/../Models/Post.php';
require_once __DIR__ . '/../Models/Category.php';
require_once __DIR__ . '/../Models/User.php';

class DashboardController
{
    public function index(): void
    {
        if (empty($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/?url=login');
            exit;
        }

        $postModel = new Post();
        $categoryModel = new Category();

        $posts = $postModel->getAll();
        $categories = $categoryModel->getAll();

        $totalPosts = count($posts);
        $totalCategories = count($categories);

        require_once __DIR__ . '/../Views/dashboard/index.php';
    }
}