<?php

session_start();
include('admin/config/dbcon.php');
$editorContent = $user_id = $titleContent = '';

//LOGGED OUT
if (isset($_POST['logout_btn'])) {
    // session_destroy();
    unset($_SESSION['auth']);
    unset($_SESSION['auth_user']);
    unset($_SESSION['auth_role']);

    $_SESSION['message'] = "Logged Out Successfully";
    header("Location: index.php");
    exit(0);
}

// If the form is submitted
if (isset($_POST['submit'])) {
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
    $titleContent = mysqli_real_escape_string($con, $_POST['title']);
    $editorContent = mysqli_real_escape_string($con, $_POST['editor']);

    // Check whether the editor content is empty
    if (!empty($editorContent) && !empty($titleContent)) {
        // Insert editor content in the database "exw krimeno to user_id se ena input gia na to sumplirwnei aytomata ka8e fora se ka8e user."
        $query = "INSERT INTO posts (title, body, user_id) VALUES ('$titleContent','$editorContent','$user_id') ";
        $query_run = mysqli_query($con, $query);

        // If database insertion is successful
        if ($query_run) {
            $_SESSION['message'] = "The editor content has been inserted successfully.";
            header("Location: new-message.php");
            exit(0);
            // $statusMsg = "The editor content has been inserted successfully.";
        } else {
            $_SESSION['message'] = "Some problem occurred, please try again.";
            header("Location: new-message.php");
            exit(0);
            // $statusMsg = "Some problem occurred, please try again.";
        }
    } else {
        $_SESSION['message'] = "Please add content in the editor.";
        header("Location: new-message.php");
        exit(0);
        // $statusMsg = 'Please add content in the editor.';
    }
}

//Update user.
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
        header("Location: edit-profile.php");
        exit(0);
    } else {
        $_SESSION['status'] = "Something went wrong!";
        header("Location: edit-profile.php");
        exit(0);
    }
}

?>