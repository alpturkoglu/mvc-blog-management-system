<?php

$title = $post['title'];

ob_start();
?>

<div class="card mb-4">
    <div class="card-body">

        <h1>
            <?= htmlspecialchars($post['title']) ?>
        </h1>

        <p class="mt-3">
            <?= nl2br(htmlspecialchars($post['content'])) ?>
        </p>

    </div>
</div>

<h3 class="mb-3">Comments</h3>

<?php if (!empty($_SESSION['user'])): ?>

<form
    action="<?= BASE_URL ?>/?url=comments/store"
    method="POST"
    class="mb-4"
>

    <?= csrfField() ?>

    <input
        type="hidden"
        name="post_id"
        value="<?= $post['id'] ?>"
    >

    <div class="mb-3">
        <textarea
            name="content"
            class="form-control"
            rows="3"
            placeholder="Write a comment..."
            required
        ></textarea>
    </div>

    <button
        type="submit"
        class="btn btn-primary"
    >
        Add Comment
    </button>

</form>

<?php endif; ?>

<?php foreach ($comments as $comment): ?>

<div class="card mb-2">
    <div class="card-body">

        <strong>
            <?= htmlspecialchars($comment['username']) ?>
        </strong>

        <p class="mb-0 mt-2">
            <?= nl2br(htmlspecialchars($comment['content'])) ?>
        </p>

    </div>
</div>

<?php endforeach; ?>

<?php
$content = ob_get_clean();

require_once __DIR__ . '/../layouts/main.php';