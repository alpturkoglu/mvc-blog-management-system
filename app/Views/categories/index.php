<?php

$title = 'Categories';

ob_start();
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Categories</h1>

    <?php if (isAdmin()): ?>
        <a href="<?= BASE_URL ?>/?url=categories/create" class="btn btn-primary">
            Create Category
        </a>
    <?php endif; ?>
</div>

<?php if (!empty($_SESSION['success'])): ?>
    <div class="alert alert-success">
        <?= htmlspecialchars($_SESSION['success']) ?>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php foreach ($categories as $category): ?>
    <div class="card mb-3">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h5><?= htmlspecialchars($category['name']) ?></h5>
                <small class="text-muted"><?= htmlspecialchars($category['slug']) ?></small>
            </div>

            <?php if (isAdmin()): ?>
                <a
                    href="<?= BASE_URL ?>/?url=categories/delete&id=<?= $category['id'] ?>"
                    class="btn btn-danger btn-sm"
                    onclick="return confirm('Delete this category?')"
                >
                    Delete
                </a>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; ?>

<?php
$content = ob_get_clean();

require_once __DIR__ . '/../layouts/main.php';