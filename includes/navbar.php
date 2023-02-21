<nav class="navbar bg-dark navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">Message App</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php if (isset($_SESSION['auth_user'])): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false"> Messages </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item"
                                    href="new-message.php?=<?= $_SESSION['auth_user']['user_id']; ?>">Add Message</a></li>
                            <li><a class="dropdown-item"
                                    href="message-history.php?=<?= $_SESSION['auth_user']['user_id']; ?>">View Messages</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false"> <?= $_SESSION['auth_user']['user_name']; ?> </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item"
                                    href="edit-profile.php?=<?= $_SESSION['auth_user']['user_id']; ?>">My Profile</a></li>
                            <form action="allcode.php" method="post">
                                <button type="submit" name="logout_btn" class="dropdown-item">Logout</button>
                            </form>
                            <li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false"> Login </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="admin-login.php">Admin</a></li>
                            <li><a class="dropdown-item" href="login.php">User</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>