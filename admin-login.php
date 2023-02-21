<?php
session_start();

if (isset($_SESSION['auth'])) {
    if (!isset($_SESSION['message'])) {
        $_SESSION['message'] = "You are already logged in";
    }
    header("Location: admin/index.php");
    exit(0);
}

include('includes/header.php');
include('includes/navbar.php');
?>
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <?php
                include('msg.php');
                ?>
                <div class="card shadow">
                    <div class="card-header">
                        <h4>Admin Login</h4>
                    </div>
                    <div class="card-body">
                        <form action="admin-logincode.php" method="post">
                            <div class="form-group mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required
                                    placeholder="Enter your email">
                            </div>
                            <div class="form-group mb-3">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required
                                    placeholder="Enter your password">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="admin_login_btn" class="btn btn-primary">Login Now</button>
                            </div>
                        </form>
                        <a href="admin-password-reset.php">Forgot your password?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include('includes/footer.php');
?>