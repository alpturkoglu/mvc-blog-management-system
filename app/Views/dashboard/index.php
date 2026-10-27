<?php

$title = 'Dashboard';

ob_start();
?>

<h1 class="mb-4">Dashboard</h1>

<div class="alert alert-info">
    Welcome, <?= htmlspecialchars($_SESSION['user']['username']) ?>.
</div>

<div class="row g-4">

    <div class="col-md-6">
        <div class="card shadow-sm border-primary">
            <div class="card-body text-center">
                <h5 class="card-title">Total Posts</h5>
                <p class="display-4">
                    <?= $totalPosts ?>
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm border-success">
            <div class="card-body text-center">
                <h5 class="card-title">Total Categories</h5>
                <p class="display-4">
                    <?= $totalCategories ?>
                </p>
            </div>
        </div>
    </div>

</div>

<div class="mt-5">
    <h3>Quick Actions</h3>

    <div class="d-flex gap-2 mt-3">

        <a
            href="<?= BASE_URL ?>/?url=posts/create"
            class="btn btn-primary"
        >
            Create Post
        </a>

        <a
            href="<?= BASE_URL ?>/?url=categories/create"
            class="btn btn-success"
        >
            Create Category
        </a>

        <a
            href="<?= BASE_URL ?>/?url=posts"
            class="btn btn-secondary"
        >
            View Posts
        </a>

    </div>
</div>

<?php
$content = ob_get_clean();

require_once __DIR__ . '/../layouts/main.php';