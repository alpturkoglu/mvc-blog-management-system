<?php

$title = 'Create Category';

ob_start();
?>

<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="card shadow-sm">
            <div class="card-body">

                <h2 class="mb-4">Create Category</h2>

                <?php if (!empty($_SESSION['error'])): ?>
                    <div class="alert alert-danger">
                        <?= htmlspecialchars($_SESSION['error']) ?>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <form action="<?= BASE_URL ?>/?url=categories/store" method="POST">

                    <?= csrfField() ?>

                    <div class="mb-3">
                        <label class="form-label">Category Name</label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            required
                        >
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Create Category
                    </button>

                    <a
                        href="<?= BASE_URL ?>/?url=categories"
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