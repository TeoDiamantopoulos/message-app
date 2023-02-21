<?php
session_start();

if (isset($_SESSION['auth'])) {
    $_SESSION['message'] = "You are already logged in";
    header("Location: index.php");
    exit(0);
} elseif (isset($_SESSION['auth_role'])) {
    if ($_SESSION['auth_role'] == "1") {
        $_SESSION['message'] = "You are not a user!";
        header("Location: admin/index.php");
        exit(0);
    }

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
                        <h5>Register</h5>
                    </div>
                    <div class="card-body">
                        <form action="registercode.php" method="post">
                            <div class="form-group mb-3">
                                <label for="">First Name</label>
                                <input type="text" name="fname" class="form-control" required
                                    placeholder="Enter your first name">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Last Name</label>
                                <input type="text" name="lname" class="form-control" required
                                    placeholder="Enter your last name">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control" required
                                    placeholder="Enter your email">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" required
                                    placeholder="Enter your password">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Confirm password</label>
                                <input type="password" name="cpassword" class="form-control" required
                                    placeholder="Confirm your password">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="register_btn" class="btn btn-primary">Register Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include('includes/footer.php');
?>