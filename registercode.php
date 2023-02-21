<?php
session_start();

include('admin/config/dbcon.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

//function for email to send verification email when a new user try to register.
function sendemail_verify($fname, $email, $verify_token)
{
    $mail = new PHPMailer(true);
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->SMTPAuth = true;

    $mail->Host = 'smtp.gmail.com';
    $mail->Username = 'phptester9@gmail.com';
    $mail->Password = 'gcwezhdcaajsnhkf'; //SMTP password

    $mail->SMTPSecure = "tls"; //Enable implicit TLS encryption 
    $mail->Port = 587;

    $mail->setFrom("phptester9@gmail.com", $fname);
    $mail->addAddress($email);

    $mail->isHTML(true); //Set email format to HTML
    $mail->Subject = 'Email Verification.';

    $email_template = "
    <h5>Verify your email address to Login with this link</h5> 
    <a href='http://localhost/message/verify-email.php?token=$verify_token'> Click Me</a> 
    ";

    $mail->Body = $email_template;
    $mail->send();
}


//if you press the resend_email_verify_btn from resend-email-verification.php which is triggered by the login.php when you press you forgot your password.
if (isset($_POST['resend_email_verify_btn'])) {
    if (!empty(trim($_POST['email']))) {
        $email = mysqli_real_escape_string($con, $_POST['email']);

        $checkemail_query = "SELECT * FROM users WHERE email='$email' LIMIT 1 ";
        $checkemail_query_run = mysqli_query($con, $checkemail_query);

        if (mysqli_num_rows($checkemail_query_run) > 0) {
            $row = mysqli_fetch_array($checkemail_query_run);
            //if you haven't verify your email. verify_status is 1 for verified users and 0 for not verified.
            if ($row['verify_status'] == "0") {
                $fname = $row['fname'];
                $email = $row['email'];
                $verify_token = $row['verify_token'];

                //call the function to send the email.
                sendemail_verify($fname, $email, $verify_token);

                $_SESSION['message'] = "Verification email has been sent to your email address.";
                header("Location: login.php");
                exit(0);

            } else {
                $_SESSION['message'] = "Email already verified. Please Login";
                header("Location: resend-email-verification.php");
                exit(0);
            }
        } else {
            $_SESSION['message'] = "Email is not registered. Please register now.";
            header("Location: register.php");
            exit(0);
        }

    } else {
        $_SESSION['message'] = "Please enter email field";
        header("Location: resend-email-verification.php");
        exit(0);
    }
}

//if you press the register_btn which is located in register.php 
if (isset($_POST['register_btn'])) {

    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['cpassword']);
    $verify_token = md5(rand());

    if ($password == $confirm_password) {
        // Check email 
        $checkemail = "SELECT email FROM users WHERE email='$email'";
        $checkemail_run = mysqli_query($con, $checkemail);

        //if email already exists.
        if (mysqli_num_rows($checkemail_run) > 0) {
            $_SESSION['message'] = "Email Already Exists";
            header("Location: register.php");
            exit(0);
        } else {
            //if email does not exist.
            // the other fields like role_as is default 0 and its for admin and user auth. if it is 0 its a user else its an admin. 
            $user_query = "INSERT INTO users (fname,lname,email,password,verify_token) VALUES ('$fname','$lname','$email','$password', '$verify_token') ";
            $user_query_run = mysqli_query($con, $user_query);

            if ($user_query_run) {

                sendemail_verify("$fname", "$email", "$verify_token");

                $_SESSION['message'] = "Register Successfully";
                header("Location: login.php");
                exit(0);
            } else {
                $_SESSION['message'] = "Something Went Wrong";
                header("Location: register.php");
                exit(0);
            }
        }


    } else {
        $_SESSION['message'] = "Password and confirm password dont match";
        header("Location: register.php");
        exit(0);
    }




} else {
    header("Location: register.php");
    exit(0);
}