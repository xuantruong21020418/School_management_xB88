<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    //get form data
    $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    

    if(!$email) {
        $_SESSION['signin'] = "Email required";
    } elseif (!$password) {
        $_SESSION['signin'] = "Password required";
    } else {
        //fetch user from db
        $fetch_user_query = "SELECT * FROM sms_user WHERE email ='$email'";
        $fetch_user_result = mysqli_query($connection, $fetch_user_query);
        if(mysqli_num_rows($fetch_user_result) == 1) {
            //convert the record into assoc array
            $user_record = mysqli_fetch_assoc($fetch_user_result);
            $db_password = $user_record['password'];
            //compare form password with database password
            if(password_verify($password, $db_password) == 1) {
                //set session for access control
                $_SESSION['user-id'] = $user_record['id'];
                //set session if admin or not
                if ($user_record['is_admin'] == 0) {
                    $_SESSION['user_is_student'] = true;
                } elseif ($user_record['is_admin'] == 1) {
                    $_SESSION['user_is_admin'] = true;
                } elseif ($user_record['is_admin'] == 2) {
                    $_SESSION['user_is_teacher'] = true;
                }

                //log user in       
                header('location: ' . ROOT_URL . 'admin/students.php');
            } else {
                header('Location: http://localhost/School_management_xB88/signin.php');
                $_SESSION['signin'] = "Please check your input";
                die();
            }
        } else {
            header('Location: http://localhost/School_management_xB88/signin.php');
            $_SESSION['signin'] = "User not found";
            die();
        }
    }
} else {
    header('Location: http://localhost/School_management_xB88/signin.php');
    die();
}

