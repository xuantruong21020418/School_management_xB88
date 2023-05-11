<?php
require 'config/database.php';

if (isset($_GET['email'])) {
    $email = filter_var($_GET['email'], FILTER_SANITIZE_EMAIL);

    //fetch teacher from db
    $query = "SELECT * FROM sms_teacher WHERE `email` = '$email'";
    $sms_user_query = "SELECT * FROM sms_user WHERE `email` = '$email'";
    $result = mysqli_query($connection, $query);
    $sms_user_result = mysqli_query($connection, $sms_user_query);
    $teacher = mysqli_fetch_assoc($result);
    $user = mysqli_fetch_assoc($sms_user_result);


    //make sure only 1 teacher retrieved
    if(mysqli_num_rows($result) == 1) {
        $photo_name = $teacher['photo'];
        $photo_path = '../images/' . $photo_name;
        //delete image if available
        if($photo_path) {
            unlink($photo_path);
        }
    }

    //delete user from db sms_teacher
    $delete_query = "DELETE FROM sms_teacher WHERE email LIKE '%$email%'";
    $delete_result = mysqli_query($connection, $delete_query);
    //delete user from db sms_user
    $delete_sms_user_query = "DELETE FROM sms_user WHERE email LIKE '%$email%'";
    $delete_sms_user_result = mysqli_query($connection, $delete_sms_user_query);
    if(mysqli_errno($connection)) {
        $_SESSION['delete-teacher'] = "Couldn't delete '{$teacher['firstname']} {$teacher['lastname']}'";
    } else {
        $_SESSION['delete-teacher-success'] = "'{$teacher['firstname']} {$teacher['lastname']}' deleted successfully";
    }
}

header('location: ' . ROOT_URL . 'admin/teachers.php');
die();