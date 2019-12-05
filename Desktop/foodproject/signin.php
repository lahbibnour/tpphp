<?php

    session_start();

    include 'classes/user.class.php';

    if(isset($_SESSION['name'])!="") {
        header("Location:  ");
    }

    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $pwd = $_POST['pwd'];
       
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            $email_error = "Please Enter Valid Email";
            goto error;
        }

        if(strlen($pwd) < 6) {
            $password_error = "Password must be minimum of 6 characters";
            goto error;
        }
        
        $user = new User;
        // $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $auth = $user->login($email, $pwd);
        if($auth === false)
        {
            $auth_error = 'Incorrect Email or Password!!!';
        } else {
            session_start();
            $_SESSION['name'] = $auth['name'];
            $_SESSION['email'] = $auth['email'];
            header("Location: acc.php");
        }
    }

    error:
    include 'signin.phtml';