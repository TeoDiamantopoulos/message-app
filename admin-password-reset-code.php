<?php
session_start();
include('admin/config/dbcon.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function send_admin_password_reset($get_name, $get_email, $token)
{
    $mail = new PHPMailer(true);
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->SMTPAuth = true;

    $mail->Host = 'smtp.gmail.com';
    $mail->Username = 'email@example.com'; //Your email
    $mail->Password = '*************'; //SMTP password

    $mail->SMTPSecure = "tls"; //Enable implicit TLS encryption 
    $mail->Port = 587;

    $mail->setFrom("email@example.com", $get_name); //Your email
    $mail->addAddress($get_email);

    $mail->isHTML(true); //Set email format to HTML
    $mail->Subject = 'Reset Password.';

    $email_template = "
    <h2>Hello</h2>
    <h3>You are receiving this email because a password reset for your account.</h3>
    <br/></br>
    <a href='http://localhost/message/admin-password-change.php?token=$token&email=$get_email'> Click Me</a> 
    ";

    $mail->Body = $email_template;
    $mail->send();

}

// admin password reset
if (isset($_POST['admin_password_reset_link'])) {

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $token = md5(rand());

    $check_email = "SELECT * FROM users WHERE email='$email' AND role_as='1' LIMIT 1 ";
    $check_email_run = mysqli_query($con, $check_email);

    if (mysqli_num_rows($check_email_run) > 0) {
        $row = mysqli_fetch_array($check_email_run);


        $get_name = $row['fname'];
        $get_email = $row['email'];

        $update_token = "UPDATE users SET verify_token='$token' WHERE email='$get_email' LIMIT 1 ";
        $update_token_run = mysqli_query($con, $update_token);
        if ($update_token_run) {
            send_admin_password_reset($get_name, $get_email, $token);

            $_SESSION['message'] = "We emailed you a password reset link";
            header("Location: admin-login.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Something went wrong";
            header("Location: admin-password-reset.php");
            exit(0);
        }
    } else {
        $_SESSION['message'] = "Please enter email field";
        header("Location: admin-password-reset.php");
        exit(0);
    }
}

//admin password update
if (isset($_POST['admin_password_update'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $new_password = mysqli_real_escape_string($con, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);

    $token = mysqli_real_escape_string($con, $_POST['password_token']);

    if (!empty($token)) {
        if (!empty($email) && !empty($new_password) && !empty($confirm_password)) {
            //Check if token is valid or not
            $check_token = "SELECT verify_token FROM users WHERE verify_token='$token' LIMIT 1 ";
            $check_token_run = mysqli_query($con, $check_token);

            if (mysqli_num_rows($check_token_run) > 0) {
                if ($new_password == $confirm_password) {
                    $update_password = "UPDATE users SET password='$new_password' WHERE verify_token='$token' LIMIT 1 ";
                    $update_password_run = mysqli_query($con, $update_password);

                    if ($update_password_run) { //Change verify token if new password succesfully update 
                        $new_token = md5(rand());
                        $update_new_token = "UPDATE users SET verify_token='$new_token' WHERE verify_token='$token' LIMIT 1 ";
                        $$update_new_token_run = mysqli_query($con, $update_new_token);

                        $_SESSION['message'] = "New Password Successfully updated.";
                        header("Location: admin-login.php");
                        exit(0);
                    } else {
                        $_SESSION['message'] = "Didn't Update Password.";
                        header("Location: admin-password-change.php?token=$token&email=$email");
                        exit(0);
                    }

                } else {
                    $_SESSION['message'] = "Confirm Password doesn't match Password";
                    header("Location: admin-password-change.php?token=$token&email=$email");
                    exit(0);
                }
            } else {
                $_SESSION['message'] = "Invalid Token";
                header("Location: admin-password-change.php?token=$token&email=$email");
                exit(0);
            }
        } else {
            $_SESSION['message'] = "All fields are Mandetory";
            header("Location: admin-password-change.php?token=$token&email=$email");
            exit(0);
        }
    } else {
        $_SESSION['message'] = "No Token Available";
        header("Location: admin-password-change.php");
        exit(0);
    }

}

?>