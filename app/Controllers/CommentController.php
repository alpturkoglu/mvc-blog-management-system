<?php

require_once __DIR__ . '/../Models/Comment.php';

class CommentController
{
    public function store(): void
    {
        requireLogin();
        verifyCsrfToken();

        $postId = (int)($_POST['post_id'] ?? 0);
        $content = trim($_POST['content'] ?? '');

        if ($postId <= 0 || $content === '') {
            header('Location: ' . BASE_URL . '/?url=posts');
            exit;
        }

        $commentModel = new Comment();

        $commentModel->create(
            $postId,
            $_SESSION['user']['id'],
            $content
        );

        header('Location: ' . BASE_URL . '/?url=posts/show&id=' . $postId);
        exit;
    }
}