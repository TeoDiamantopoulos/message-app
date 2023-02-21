<?php
session_start();

if (isset($_SESSION['auth_role'])) {
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
        <div class="row">
            <div class="col-md-12 text-center">
                <?php include('msg.php'); ?>
                <h1>Message App</h1>
                <p>For Users And Admins</p>
            </div>
        </div>
    </div>
</div>
<?php
include('includes/footer.php');
?>