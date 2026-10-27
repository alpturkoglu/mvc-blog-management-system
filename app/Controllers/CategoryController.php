<?php

require_once __DIR__ . '/../Models/Category.php';

class CategoryController
{
    public function index(): void
    {
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();

        require_once __DIR__ . '/../Views/categories/index.php';
    }

    public function create(): void
    {
        requireAdmin();

        require_once __DIR__ . '/../Views/categories/create.php';
    }

    public function store(): void
    {
        requireAdmin();
        verifyCsrfToken();

        $name = trim($_POST['name'] ?? '');

        if ($name === '') {
            $_SESSION['error'] = 'Category name is required.';
            header('Location: ' . BASE_URL . '/?url=categories/create');
            exit;
        }

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));

        $categoryModel = new Category();
        $categoryModel->create($name, $slug);

        $_SESSION['success'] = 'Category created successfully.';
        header('Location: ' . BASE_URL . '/?url=categories');
        exit;
    }

    public function delete(): void
    {
        requireAdmin();

        $id = (int)($_GET['id'] ?? 0);

        if ($id > 0) {
            $categoryModel = new Category();
            $categoryModel->delete($id);
        }

        header('Location: ' . BASE_URL . '/?url=categories');
        exit;
    }
}