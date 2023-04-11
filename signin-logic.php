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

            //     //convert the record into assoc array
            //     $user_record = mysqli_fetch_assoc($fetch_user_result);
            //     $db_password = $user_record['password'];
            //     $db_email = $user_record['email'];
            //     $hashed_password = '$2y$10$NoV5HrVAWpwJDVlTAcGzyO5QIQYBbm8hKToBalpNRveCAHnCquVse';
            //     echo "$password ", "$db_password ", "$db_email ";
            //     if($password == $db_password) {
            //         print "1";
            //         } else {
            //             print "0";
            //         }
            //     }
            // }

        if(mysqli_num_rows($fetch_user_result) == 1) {
            //convert the record into assoc array
            $user_record = mysqli_fetch_assoc($fetch_user_result);
            $db_password = $user_record['password'];
            //compare form password with database password
            if(password_verify($password, $db_password) == 1) {
                //set session for access control
                $_SESSION['user-id'] = $user_record['id'];
                //set session if admin or not
                if ($user_record['is_admin'] == 1) {
                    $_SESSION['user_is_admin'] = true;
                }

                //log user in
                header('location: ' . ROOT_URL . 'admin/students.php');
            } else {
                $_SESSION['signin'] = "Please check your input";
                header('Location: http://localhost/School_management_xB88/signin.php');
                die();
            }
        } else {
            $_SESSION['signin'] = "User not found";
            header('Location: http://localhost/School_management_xB88/signin.php');
            die();
        }
    }
} else {
    header('Location: http://localhost/School_management_xB88/signin.php');
    die();
}

