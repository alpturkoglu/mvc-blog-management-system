<?php

$title = 'Home - MVC Blog System';

ob_start();
?>

<div class="p-5 mb-4 bg-white rounded-3 shadow-sm">
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Welcome to MVC Blog System</h1>
        <p class="col-md-8 fs-4">
            A professional personal blog system built with pure PHP, MVC architecture and Bootstrap 5.
        </p>

        <a href="<?= BASE_URL ?>/?url=posts" class="btn btn-primary btn-lg">
            Get Started
        </a>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">MVC Architecture</h5>
                <p class="card-text">
                    Clean separation between Models, Views and Controllers.
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">User System</h5>
                <p class="card-text">
                    Registration, login, roles and profile features will be included.
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Blog Features</h5>
                <p class="card-text">
                    Posts, categories, comments, search and pagination.
                </p>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();

require_once __DIR__ . '/layouts/main.php';