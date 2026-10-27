<?php

$title = 'My Profile';

ob_start();
?>

<h1 class="mb-4">My Profile</h1>

<div class="card shadow-sm mb-4">
    <div class="card-body">

        <h5>Username</h5>
        <p><?= htmlspecialchars($_SESSION['user']['username']) ?></p>

        <h5>Email</h5>
        <p><?= htmlspecialchars($_SESSION['user']['email']) ?></p>

        <h5>Role</h5>
        <p><?= htmlspecialchars($_SESSION['user']['role']) ?></p>

        <a
            href="<?= BASE_URL ?>/?url=profile/change-password"
            class="btn btn-warning"
        >
            Change Password
        </a>

    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <h3 class="mb-3">My Posts</h3>

        <?php if (empty($ownPosts)): ?>

            <div class="alert alert-info">
                You have not created any posts yet.
            </div>

        <?php else: ?>

            <ul class="list-group">

                <?php foreach ($ownPosts as $post): ?>

                    <li class="list-group-item d-flex justify-content-between">

                        <?= htmlspecialchars($post['title']) ?>

                        <span class="badge bg-secondary">
                            <?= htmlspecialchars($post['status']) ?>
                        </span>

                    </li>

                <?php endforeach; ?>

            </ul>

        <?php endif; ?>

    </div>
</div>

<?php
$content = ob_get_clean();

require_once __DIR__ . '/../layouts/main.php';