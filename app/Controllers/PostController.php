<?php

require_once __DIR__ . '/../Models/Post.php';
require_once __DIR__ . '/../Models/Category.php';
require_once __DIR__ . '/../Models/Comment.php';

class PostController
{
    public function index(): void
    {
        $postModel = new Post();

        $keyword = trim($_GET['search'] ?? '');
        $perPage = 10;
        $currentPage = max(1, (int)($_GET['page'] ?? 1));
        $offset = ($currentPage - 1) * $perPage;

        if ($keyword !== '') {
            $posts = $postModel->search($keyword);
            $totalPosts = count($posts);
            $totalPages = 1;
        } else {
            $isAdmin = isAdmin();

            $posts = $postModel->getPaginated($perPage, $offset, $isAdmin);
            $totalPosts = $postModel->countAll($isAdmin);
            $totalPages = (int)ceil($totalPosts / $perPage);
        }

        require_once __DIR__ . '/../Views/posts/index.php';
    }

    public function show(): void
    {
        $id = (int)($_GET['id'] ?? 0);

        $postModel = new Post();
        $post = $postModel->find($id);

        if (!$post) {
            header('Location: ' . BASE_URL . '/?url=posts');
            exit;
        }

        if ($post['status'] !== 'published') {
            if (
                empty($_SESSION['user']) ||
                (
                    $_SESSION['user']['id'] != $post['user_id'] &&
                    !isAdmin()
                )
            ) {
                header('Location: ' . BASE_URL . '/?url=posts');
                exit;
            }
        }

        $commentModel = new Comment();
        $comments = $commentModel->getByPostId($id);

        require_once __DIR__ . '/../Views/posts/show.php';
    }

    public function create(): void
    {
        requireLogin();

        $categoryModel = new Category();
        $categories = $categoryModel->getAll();

        require_once __DIR__ . '/../Views/posts/create.php';
    }

    public function store(): void
    {
        requireLogin();
        verifyCsrfToken();

        $title = trim($_POST['title'] ?? '');
        $content = trim($_POST['content'] ?? '');
        $categoryId = !empty($_POST['category_id']) ? (int)$_POST['category_id'] : null;
        $status = $_POST['status'] ?? 'draft';

        if (!in_array($status, ['draft', 'published'], true)) {
            $status = 'draft';
        }

        if ($title === '' || $content === '') {
            $_SESSION['error'] = 'Title and content are required.';
            header('Location: ' . BASE_URL . '/?url=posts/create');
            exit;
        }

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
        $slug = $slug . '-' . time();

        $postModel = new Post();

        $postModel->create(
            $title,
            $slug,
            $content,
            $_SESSION['user']['id'],
            $categoryId,
            $status
        );

        $_SESSION['success'] = 'Post created successfully.';
        header('Location: ' . BASE_URL . '/?url=posts');
        exit;
    }

    public function edit(): void
    {
        requireLogin();

        $id = (int)($_GET['id'] ?? 0);

        $postModel = new Post();
        $post = $postModel->find($id);

        if (!$post) {
            header('Location: ' . BASE_URL . '/?url=posts');
            exit;
        }

        if ($post['user_id'] != $_SESSION['user']['id'] && !isAdmin()) {
            header('Location: ' . BASE_URL . '/?url=posts');
            exit;
        }

        $categoryModel = new Category();
        $categories = $categoryModel->getAll();

        require_once __DIR__ . '/../Views/posts/edit.php';
    }

    public function update(): void
    {
        requireLogin();
        verifyCsrfToken();

        $id = (int)($_POST['id'] ?? 0);
        $title = trim($_POST['title'] ?? '');
        $content = trim($_POST['content'] ?? '');
        $categoryId = !empty($_POST['category_id']) ? (int)$_POST['category_id'] : null;
        $status = $_POST['status'] ?? 'draft';

        if (!in_array($status, ['draft', 'published'], true)) {
            $status = 'draft';
        }

        if ($id <= 0 || $title === '' || $content === '') {
            $_SESSION['error'] = 'Title and content are required.';
            header('Location: ' . BASE_URL . '/?url=posts');
            exit;
        }

        $postModel = new Post();
        $post = $postModel->find($id);

        if (!$post) {
            header('Location: ' . BASE_URL . '/?url=posts');
            exit;
        }

        if ($post['user_id'] != $_SESSION['user']['id'] && !isAdmin()) {
            header('Location: ' . BASE_URL . '/?url=posts');
            exit;
        }

        $postModel->update($id, $title, $content, $categoryId, $status);

        $_SESSION['success'] = 'Post updated successfully.';
        header('Location: ' . BASE_URL . '/?url=posts');
        exit;
    }

    public function delete(): void
    {
        requireLogin();

        $id = (int)($_GET['id'] ?? 0);

        if ($id > 0) {
            $postModel = new Post();
            $post = $postModel->find($id);

            if (
                $post &&
                (
                    $post['user_id'] == $_SESSION['user']['id'] ||
                    isAdmin()
                )
            ) {
                $postModel->delete($id);
            }
        }

        header('Location: ' . BASE_URL . '/?url=posts');
        exit;
    }
}