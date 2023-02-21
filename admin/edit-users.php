<?php
session_start();
include('authentication.php');
include('includes/header.php');
?>
<div class="container-fluid px-4">
    <h5 class="mt-4">Edit Users</h5>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Manage Users</li>
        <li class="breadcrumb-item">Edit Users</li>
    </ol>
    <?php
    include('msg.php');
    ?>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mt-5 ">
                <div class="card-header">
                    <h2>Edit Users</h2>
                </div>
                <div class="card-body ">
                    <?php
                    if (isset($_GET['id'])) {
                        $user_id = mysqli_real_escape_string($con, $_GET['id']);
                        $users = "SELECT * FROM users WHERE id='$user_id' AND role_as='0' ";
                        $users_run = mysqli_query($con, $users);

                        if (mysqli_num_rows($users_run) > 0) {

                            foreach ($users_run as $user) {

                                ?>
                                <form action="code.php" method="post">
                                    <input type="hidden" name="user_id" value="<?= $user['id']; ?>">
                                    <div class="form-group mb-3">
                                        <label for="">First Name</label>
                                        <input type="text" name="fname" value="<?= $user['fname']; ?>" class="form-control" required
                                            placeholder="Edit first name">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="">Last Name</label>
                                        <input type="text" name="lname" value="<?= $user['lname']; ?>" class="form-control" required
                                            placeholder="Edit last name">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="">Email</label>
                                        <input type="email" name="email" value="<?= $user['email']; ?>" class="form-control"
                                            required placeholder="Edit email">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="">Password</label>
                                        <input type="text" name="password" value="<?= $user['password']; ?>" class="form-control"
                                            required placeholder="Edit password">
                                    </div>
                                    <div class="form-group mb-3">
                                        <button type="submit" name="update_user" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                                <?php
                            }
                        } else {
                            ?>
                            <h4>No record found</h4>
                            <?php
                        }
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php

    include('includes/footer.php');
    include('includes/scripts.php');

    ?>