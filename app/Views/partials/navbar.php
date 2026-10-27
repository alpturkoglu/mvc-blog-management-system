<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?= BASE_URL ?>/">MVC Blog</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link active" href="<?= BASE_URL ?>/">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>/?url=posts">Posts</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>/?url=categories">Categories</a>
                </li>

                <?php if (!empty($_SESSION['user'])): ?>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>/?url=dashboard">Dashboard</a>
                    </li>

                    <?php if (isAdmin()): ?>
                        <li class="nav-item">
                            <a class="nav-link text-warning" href="<?= BASE_URL ?>/?url=admin">
                                Admin Panel
                            </a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>/?url=posts/create">
                            Create Post
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>/?url=profile">
                            Profile
                        </a>
                    </li>

                    <li class="nav-item">
                        <span class="nav-link text-white">
                            <?= htmlspecialchars($_SESSION['user']['username']) ?>
                        </span>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>/?url=logout">
                            Logout
                        </a>
                    </li>

                <?php else: ?>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>/?url=login">
                            Login
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>/?url=register">
                            Register
                        </a>
                    </li>

                <?php endif; ?>

            </ul>
        </div>
    </div>
</nav>