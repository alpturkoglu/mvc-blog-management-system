<?php

require_once __DIR__ . '/../Models/Post.php';
require_once __DIR__ . '/../Models/User.php';

class ProfileController
{
    public function index(): void
    {
        requireLogin();

        $postModel = new Post();
        $posts = $postModel->getAll();

        $ownPosts = array_filter($posts, function ($post) {
            return $post['user_id'] == $_SESSION['user']['id'];
        });

        require_once __DIR__ . '/../Views/profile/index.php';
    }

    public function changePassword(): void
    {
        requireLogin();

        require_once __DIR__ . '/../Views/profile/change-password.php';
    }

    public function updatePassword(): void
    {
        requireLogin();
        verifyCsrfToken();

        $currentPassword = $_POST['current_password'] ?? '';
        $newPassword = $_POST['new_password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        if ($currentPassword === '' || $newPassword === '' || $confirmPassword === '') {
            $_SESSION['error'] = 'All fields are required.';
            header('Location: ' . BASE_URL . '/?url=profile/change-password');
            exit;
        }

        if ($newPassword !== $confirmPassword) {
            $_SESSION['error'] = 'New passwords do not match.';
            header('Location: ' . BASE_URL . '/?url=profile/change-password');
            exit;
        }

        $userModel = new User();
        $user = $userModel->findByEmail($_SESSION['user']['email']);

        if (!$user || !password_verify($currentPassword, $user['password'])) {
            $_SESSION['error'] = 'Current password is incorrect.';
            header('Location: ' . BASE_URL . '/?url=profile/change-password');
            exit;
        }

        $userModel->updatePassword($_SESSION['user']['id'], $newPassword);

        $_SESSION['success'] = 'Password changed successfully.';
        header('Location: ' . BASE_URL . '/?url=profile');
        exit;
    }
}