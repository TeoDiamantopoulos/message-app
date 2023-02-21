<?php
session_start();

if (isset($_SESSION['auth'])) {
  $_SESSION['message'] = "You are already logged in";
  header("Location: index.php");
  exit(0);
}

include('includes/header.php');
include('includes/navbar.php');
?>
<div class="py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <?php
        include('msg.php');
        ?>
        <div class="card shadow">
          <div class="card-header">
            <h5>Change Password</h5>
          </div>
          <div class="card-body p-4">
            <form action="password-reset-code.php" method="post">
              <input type="hidden" name="password_token" value="<?php if (isset($_GET['token'])) {
                echo $_GET['token'];
              } ?>">
              <div class="form-group mb-3">
                <label for="">Email</label>
                <input type="email" name="email" value="<?php if (isset($_GET['email'])) {
                  echo $_GET['email'];
                } ?>" class="form-control" placeholder="Enter your email">
              </div>
              <div class="form-group mb-3">
                <label for="">New Password</label>
                <input type="password" name="new_password" class="form-control" placeholder="Enter your new password"
                  required>
              </div>
              <div class="form-group mb-3">
                <label for="">Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" placeholder="confirm your password"
                  required>
              </div>
              <div class="form-group mb-3">
                <button type="submit" name="password_update" class="btn btn-primary">Update Password</button>
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