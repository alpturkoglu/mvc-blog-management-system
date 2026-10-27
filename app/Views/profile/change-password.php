<?php

$title = 'Change Password';

ob_start();
?>

<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="card shadow-sm">
            <div class="card-body">

                <h2 class="mb-4">Change Password</h2>

                <?php if (!empty($_SESSION['error'])): ?>
                    <div class="alert alert-danger">
                        <?= htmlspecialchars($_SESSION['error']) ?>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <form
                    action="<?= BASE_URL ?>/?url=profile/update-password"
                    method="POST"
                >

                    <?= csrfField() ?>

                    <div class="mb-3">
                        <label class="form-label">
                            Current Password
                        </label>

                        <input
                            type="password"
                            name="current_password"
                            class="form-control"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            New Password
                        </label>

                        <input
                            type="password"
                            name="new_password"
                            class="form-control"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Confirm New Password
                        </label>

                        <input
                            type="password"
                            name="confirm_password"
                            class="form-control"
                            required
                        >
                    </div>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Update Password
                    </button>

                </form>

            </div>
        </div>

    </div>
</div>

<?php
$content = ob_get_clean();

require_once __DIR__ . '/../layouts/main.php';