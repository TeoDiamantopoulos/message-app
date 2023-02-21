<?php
session_start();

if (!isset($_SESSION['auth'])) {
    $_SESSION['message'] = "You have to login";
    header("Location: login.php");
    exit(0);
} elseif (isset($_SESSION['auth_role'])) {
    if ($_SESSION['auth_role'] == "1") {
        $_SESSION['message'] = "You are not a user!";
        header("Location: admin/index.php");
        exit(0);
    }

}

include('admin/config/dbcon.php');
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
                <div class="card mt-5 ">
                    <div class="card-header">
                        <h2>My Profile</h2>
                    </div>
                    <div class="card-body ">
                        <?php
                        $current_id = $_SESSION['auth_user']['user_id'];
                        $users = "SELECT * FROM users WHERE id='$current_id' ";
                        $users_run = mysqli_query($con, $users);

                        if (mysqli_num_rows($users_run) > 0) {
                            foreach ($users_run as $user) {
                                ?>
                                <form action="allcode.php" method="post">
                                    <div class="form-group mb-3">
                                        <label for="">First Name</label>
                                        <input type="text" name="fname" value="<?= $user['fname']; ?>" class="form-control"
                                            required placeholder="Edit first name">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="">Last Name</label>
                                        <input type="text" name="lname" value="<?= $user['lname']; ?>" class="form-control"
                                            required placeholder="Edit last name">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="">Email</label>
                                        <input type="email" name="email" value="<?= $user['email']; ?>" class="form-control"
                                            required placeholder="Edit email">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="">Password</label>
                                        <input type="text" name="password" value="<?= $user['password']; ?>"
                                            class="form-control" required placeholder="Edit password">
                                    </div>
                                    <div class="form-group mb-3">
                                        <button type="submit" name="update_user" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                                <?php
                            }
                        }


                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include('includes/footer.php');
    ?>