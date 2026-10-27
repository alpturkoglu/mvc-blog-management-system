<?php

require_once __DIR__ . '/../Models/User.php';

class AuthController
{
    public function showRegister(): void
    {
        require_once __DIR__ . '/../Views/auth/register.php';
    }

    public function register(): void
    {
        verifyCsrfToken();

        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($username === '' || $email === '' || $password === '') {
            $_SESSION['error'] = 'All fields are required.';
            header('Location: ' . BASE_URL . '/?url=register');
            exit;
        }

        $userModel = new User();

        if ($userModel->findByEmail($email)) {
            $_SESSION['error'] = 'Email already exists.';
            header('Location: ' . BASE_URL . '/?url=register');
            exit;
        }

        $userModel->create($username, $email, $password);

        $_SESSION['success'] = 'Registration successful. You can login now.';
        header('Location: ' . BASE_URL . '/?url=login');
        exit;
    }

    public function showLogin(): void
    {
        require_once __DIR__ . '/../Views/auth/login.php';
    }

    public function login(): void
    {
        verifyCsrfToken();

        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($email === '' || $password === '') {
            $_SESSION['error'] = 'Email and password are required.';
            header('Location: ' . BASE_URL . '/?url=login');
            exit;
        }

        $userModel = new User();
        $user = $userModel->findByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            $_SESSION['error'] = 'Invalid email or password.';
            header('Location: ' . BASE_URL . '/?url=login');
            exit;
        }

        $_SESSION['user'] = [
            'id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'role' => $user['role']
        ];

        $_SESSION['success'] = 'You are logged in successfully.';
        header('Location: ' . BASE_URL . '/');
        exit;
    }

    public function logout(): void
    {
        unset($_SESSION['user']);
        $_SESSION['success'] = 'You are logged out successfully.';
        header('Location: ' . BASE_URL . '/?url=login');
        exit;
    }
}