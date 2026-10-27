<?php

require_once __DIR__ . '/../Models/Post.php';
require_once __DIR__ . '/../Models/Category.php';

class AdminController
{
    public function index(): void
    {
        requireAdmin();

        $postModel = new Post();
        $categoryModel = new Category();

        $posts = $postModel->getAll();
        $categories = $categoryModel->getAll();

        require_once __DIR__ . '/../Views/admin/index.php';
    }
}