<?php

session_start();

define('BASE_URL', rtrim(getenv('APP_BASE_URL') ?: '', '/'));

function isLoggedIn(): bool
{
    return !empty($_SESSION['user']);
}

function isAdmin(): bool
{
    return !empty($_SESSION['user'])
        && ($_SESSION['user']['role'] ?? '') === 'admin';
}

function requireLogin(): void
{
    if (!isLoggedIn()) {
        header('Location: ' . BASE_URL . '/?url=login');
        exit;
    }
}

function requireAdmin(): void
{
    if (!isAdmin()) {
        header('Location: ' . BASE_URL . '/?url=dashboard');
        exit;
    }
}

function csrfToken(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function csrfField(): string
{
    return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars(csrfToken()) . '">';
}

function verifyCsrfToken(): void
{
    $token = $_POST['csrf_token'] ?? '';

    if (
        empty($_SESSION['csrf_token']) ||
        !hash_equals($_SESSION['csrf_token'], $token)
    ) {
        http_response_code(403);
        echo '403 - Invalid CSRF token';
        exit;
    }
}