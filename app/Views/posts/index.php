<?php

$title = 'Posts';

ob_start();
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Blog Posts</h1>

    <?php if (!empty($_SESSION['user'])): ?>
        <a href="<?= BASE_URL ?>/?url=posts/create" class="btn btn-primary">
            Create Post
        </a>
    <?php endif; ?>
</div>

<form action="<?= BASE_URL ?>/" method="GET" class="mb-4">
    <input type="hidden" name="url" value="posts">

    <div class="input-group">
        <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Search by title, content or author..."
            value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
        >

        <button class="btn btn-outline-primary" type="submit">
            Search
        </button>

        <a href="<?= BASE_URL ?>/?url=posts" class="btn btn-outline-secondary">
            Clear
        </a>
    </div>
</form>

<?php if (!empty($_SESSION['success'])): ?>
    <div class="alert alert-success">
        <?= htmlspecialchars($_SESSION['success']) ?>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php if (empty($posts)): ?>
    <div class="alert alert-warning">
        No posts found.
    </div>
<?php endif; ?>

<?php foreach ($posts as $post): ?>

<div class="card mb-3">
    <div class="card-body">

        <div class="d-flex justify-content-between align-items-start">
            <h3>
                <?= htmlspecialchars($post['title']) ?>
            </h3>

            <?php if (!empty($post['status'])): ?>
                <span class="badge <?= $post['status'] === 'published' ? 'bg-success' : 'bg-secondary' ?>">
                    <?= htmlspecialchars(ucfirst($post['status'])) ?>
                </span>
            <?php endif; ?>
        </div>

        <p>
            <?= nl2br(htmlspecialchars(substr($post['content'], 0, 200))) ?>
        </p>

        <small class="text-muted d-block">
            Author:
            <?= htmlspecialchars($post['username']) ?>
        </small>

        <small class="text-muted d-block">
            Category:
            <?= htmlspecialchars($post['category_name'] ?? 'No category') ?>
        </small>

        <div class="mt-3">

            <a
                href="<?= BASE_URL ?>/?url=posts/show&id=<?= $post['id'] ?>"
                class="btn btn-info btn-sm"
            >
                View
            </a>

            <?php if (
                !empty($_SESSION['user']) &&
                (
                    $_SESSION['user']['id'] == $post['user_id'] ||
                    isAdmin()
                )
            ): ?>

                <a
                    href="<?= BASE_URL ?>/?url=posts/edit&id=<?= $post['id'] ?>"
                    class="btn btn-warning btn-sm"
                >
                    Edit
                </a>

                <a
                    href="<?= BASE_URL ?>/?url=posts/delete&id=<?= $post['id'] ?>"
                    class="btn btn-danger btn-sm"
                    onclick="return confirm('Delete this post?')"
                >
                    Delete
                </a>

            <?php endif; ?>

        </div>

    </div>
</div>

<?php endforeach; ?>

<?php if (empty($_GET['search']) && !empty($totalPages) && $totalPages > 1): ?>
    <nav class="mt-4">
        <ul class="pagination justify-content-center">

            <?php if ($currentPage > 1): ?>
                <li class="page-item">
                    <a
                        class="page-link"
                        href="<?= BASE_URL ?>/?url=posts&page=<?= $currentPage - 1 ?>"
                    >
                        Previous
                    </a>
                </li>
            <?php endif; ?>

            <?php for ($page = 1; $page <= $totalPages; $page++): ?>
                <li class="page-item <?= $page === $currentPage ? 'active' : '' ?>">
                    <a
                        class="page-link"
                        href="<?= BASE_URL ?>/?url=posts&page=<?= $page ?>"
                    >
                        <?= $page ?>
                    </a>
                </li>
            <?php endfor; ?>

            <?php if ($currentPage < $totalPages): ?>
                <li class="page-item">
                    <a
                        class="page-link"
                        href="<?= BASE_URL ?>/?url=posts&page=<?= $currentPage + 1 ?>"
                    >
                        Next
                    </a>
                </li>
            <?php endif; ?>

        </ul>
    </nav>
<?php endif; ?>

<?php
$content = ob_get_clean();

require_once __DIR__ . '/../layouts/main.php';