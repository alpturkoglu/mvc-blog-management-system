<?php

$title = 'Edit Post';

ob_start();
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="mb-4">Edit Post</h2>

                <form action="<?= BASE_URL ?>/?url=posts/update" method="POST">

                    <?= csrfField() ?>

                    <input
                        type="hidden"
                        name="id"
                        value="<?= htmlspecialchars($post['id']) ?>"
                    >

                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input
                            type="text"
                            name="title"
                            class="form-control"
                            value="<?= htmlspecialchars($post['title']) ?>"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Category</label>

                        <select
                            name="category_id"
                            class="form-select"
                        >
                            <option value="">No category</option>

                            <?php foreach ($categories as $category): ?>

                                <option
                                    value="<?= $category['id'] ?>"
                                    <?= ($post['category_id'] == $category['id']) ? 'selected' : '' ?>
                                >
                                    <?= htmlspecialchars($category['name']) ?>
                                </option>

                            <?php endforeach; ?>

                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>

                        <select
                            name="status"
                            class="form-select"
                            required
                        >
                            <option
                                value="draft"
                                <?= ($post['status'] === 'draft') ? 'selected' : '' ?>
                            >
                                Draft
                            </option>

                            <option
                                value="published"
                                <?= ($post['status'] === 'published') ? 'selected' : '' ?>
                            >
                                Published
                            </option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Content</label>

                        <textarea
                            name="content"
                            class="form-control"
                            rows="8"
                            required
                        ><?= htmlspecialchars($post['content']) ?></textarea>
                    </div>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Update Post
                    </button>

                    <a
                        href="<?= BASE_URL ?>/?url=posts"
                        class="btn btn-secondary"
                    >
                        Cancel
                    </a>

                </form>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();

require_once __DIR__ . '/../layouts/main.php';