<?php

    session_start();

    include 'classes/user.class.php';

    if(isset($_SESSION['name'])!="") {
        header("Location: ");
    }

    if (isset($_POST['signup'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $pwd = $_POST['pwd'];
        $cpwd = $_POST['cpwd'];
        $phnno = $_POST['phnno'];
        $address = $_POST['address'];

        if (!preg_match("/^[a-zA-Z0-9 ]+$/",$name)) {
            $name_error = "Name must contain only letters, numbers and space";
            goto error;
        }

        if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            $email_error = "Please Enter Valid Email";
            goto error;
        }

        if(strlen($pwd) < 6) {
            $password_error = "Password must be minimum of 6 characters";
            goto error;
        }

        if($pwd != $cpwd) {
            $cpassword_error = "Password and Confirm Password doesn't match";
            goto error;
        }

        if(strlen($phnno) < 8) {
            $phone_error = "Phone must be  of 8 characters";
            goto error;
        }
        if (!preg_match("/^[a-zA-Z0-9 ]+$/",$address)) {
            $address_error = "Address must contain only letters, numbers and space";
            goto error;
        }

        $user = new User;
        $hashed_password = password_hash($pwd, PASSWORD_DEFAULT);
        $user->register($name, $email,$hashed_password,$phnno,$address);
        header('Location:signin.php');
        exit();
    }
    error:
    include 'signup.phtml';