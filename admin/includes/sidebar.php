<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading"></div>
                <a class="nav-link" href="index.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div> Admin Panel
                </a>
                <a class="nav-link" href="manage-users.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div> Manage Users
                </a>
                <a class="nav-link" href="all-messages.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-message"></i></div> All Messages
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            <?= $_SESSION['auth_user']['user_name']; ?>
        </div>
    </nav>
</div>