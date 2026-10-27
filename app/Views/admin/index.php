<?php

$title = 'Admin Panel';

ob_start();
?>

<h1 class="mb-4">Admin Panel</h1>

<div class="alert alert-warning">
    This page is accessible only by admin users.
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card shadow-sm border-warning">
            <div class="card-body text-center">
                <h5>Total Posts</h5>
                <p class="display-4"><?= count($posts) ?></p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm border-warning">
            <div class="card-body text-center">
                <h5>Total Categories</h5>
                <p class="display-4"><?= count($categories) ?></p>
            </div>
        </div>
    </div>
</div>

<div class="mt-5">
    <h3>Admin Actions</h3>

    <div class="d-flex gap-2 mt-3">
        <a href="<?= BASE_URL ?>/?url=posts" class="btn btn-primary">
            Manage Posts
        </a>

        <a href="<?= BASE_URL ?>/?url=categories" class="btn btn-success">
            Manage Categories
        </a>
    </div>
</div>

<?php
$content = ob_get_clean();

require_once __DIR__ . '/../layouts/main.php';