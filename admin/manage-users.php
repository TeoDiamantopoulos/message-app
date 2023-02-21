<?php
session_start();
include('authentication.php');
include('includes/header.php');
?>
<div class="container-fluid px-4">
    <h5 class="mt-4">Manage Users</h5>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Admin Panel</li>
        <li class="breadcrumb-item">Manage Users</li>
    </ol>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <?php
            include('msg.php');
            ?>
            <div class="card mt-5 ">
                <div class="card-header">
                    <h2>Registered Users</h2>
                </div>
                <div class="card-body ">
                    <table class="table table-borded">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Last Interactive</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM users WHERE role_as='0' ";
                            $query_run = mysqli_query($con, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $row) {
                                    $orgDate = $row['created_at'];
                                    $newDate = date("d-m-Y", strtotime($orgDate));
                                    ?>
                                    <tr>
                                        <td>
                                            <?= $row['id']; ?>
                                        </td>
                                        <td>
                                            <?= $row['fname']; ?>
                                        </td>
                                        <td>
                                            <?= $row['lname']; ?>
                                        </td>
                                        <td>
                                            <?= $row['email']; ?>
                                        </td>
                                        </td>
                                        <td>
                                            <?php echo "$newDate"; ?>
                                        </td>
                                        <td>
                                            <a href="edit-users.php?id=<?= $row['id']; ?>"
                                                class="btn btn-success btn-sm">Edit</a>
                                            <form action="code.php" method="post" class="d-inline">
                                                <button type="submit" name="delete_user" value="<?= $row['id']; ?>"
                                                    class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                            <a href="view-messages.php?id=<?= $row['id']; ?>"
                                                class="btn btn-info btn-sm">Messages</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="5">No Record Found</td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php

    include('includes/footer.php');
    include('includes/scripts.php');

    ?>