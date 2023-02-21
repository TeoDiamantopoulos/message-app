<?php

include('authentication.php');

if (isset($_POST['update_user'])) {
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $query = "UPDATE users SET fname='$fname', lname='$lname', email='$email', password='$password' WHERE id='$user_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Update Successfully";
        header("Location: manage-users.php");
        exit(0);
    } else {
        $_SESSION['status'] = "Something went wrong!";
        header("Location: manage-users.php");
        exit(0);
    }
}

if (isset($_POST['delete_user'])) {
    $user_id = mysqli_real_escape_string($con, $_POST['delete_user']);

    $query = "DELETE FROM users WHERE id='$user_id' ";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['status'] = "User Successfully Deleted";
        header("Location: manage-users.php");
        exit(0);
    } else {
        $_SESSION['status'] = "Something went wrong!";
        header("Location: manage-users.php");
        exit(0);
    }
}
?>