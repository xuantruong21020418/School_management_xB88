<?php
require 'config/database.php';

if(isset($_GET['email'])) {
    $email = filter_var($_GET['email'], FILTER_SANITIZE_EMAIL);
    
    //fetch user from db sms_students
    $sms_students_query = "SELECT * FROM sms_students WHERE email LIKE '%$email%'";
    $sms_students_result = mysqli_query($connection, $sms_students_query);
    $sms_students_student = mysqli_fetch_assoc($sms_students_result);

    //fetch user from db sms_users
    $sms_user_query = "SELECT * FROM sms_user WHERE email LIKE '%$email%'";
    $sms_user_result = mysqli_query($connection, $sms_user_query);
    $sms_user_student = mysqli_fetch_assoc($sms_user_result);

    
    //make sure only 1 user retrieved
    if(mysqli_num_rows($sms_students_result) == 1) {
        $photo_name = $sms_students_student['photo'];
        $photo_path = '../images/' . $photo_name;
        //delete image if available
        if($photo_path) {
            unlink($photo_path);
        }
    }

    //delete user from db sms_students
    $delete_sms_students_student_query = "DELETE FROM sms_students WHERE email LIKE '%$email%'";
    $delete_sms_students_student_result = mysqli_query($connection, $delete_sms_students_student_query);
    //delete user from db sms_user
    $delete_sms_user_student_query = "DELETE FROM sms_user WHERE email LIKE '%$email%'";
    $delete_sms_user_student_result = mysqli_query($connection, $delete_sms_user_student_query);
    if(mysqli_errno($connection)) {
        $_SESSION['delete-student'] = "Couldn't delete '{$sms_students_student['name']}'";
    } else {
        $_SESSION['delete-student-success'] = "'{$sms_students_student['name']}' deleted successfully";
    }
}

header('location: ' . ROOT_URL . 'admin/students.php');
die();