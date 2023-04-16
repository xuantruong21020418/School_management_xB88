<?php 
require 'config/database.php';
if(isset($_POST['submit'])) {
    //get updated form data
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $admission_date = filter_var($_POST['admission_date'], FILTER_SANITIZE_NUMBER_INT);
    $dob = filter_var($_POST['dob'], FILTER_SANITIZE_NUMBER_INT);
    $class = $_POST['class'];
    $section = $_POST['section'];
    $subject = $_POST['subject'];
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $mobile = filter_var($_POST['mobile'], FILTER_SANITIZE_NUMBER_INT);
    $address = filter_var($_POST['address'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    //check for valid input
    // if(!$firstname || !$lastname || !$admission_no || $admission_date 
    // || $dob || $class || $section || $email || $mobile || $address || $mother_name || $father_name) {
    //     $_SESSION['edit-student'] = "Invalid Form Input on Edit Page";
    // } else {
      //update user
        $sms_user_query = "UPDATE sms_user SET firstname='$firstname', lastname='$lastname'
        WHERE email='$email'
        LIMIT 1";

      //update teacher
        $sms_teacher_query = "UPDATE sms_teacher SET firstname='$firstname', lastname='$lastname',
        email='$email', dob='$dob', mobile='$mobile', current_address = '$address', class='$class', 
        section='$section', admission_date='$admission_date', subject='$subject'
        WHERE `email` = '$email'
        LIMIT 1";

        $sms_teacher_result = mysqli_query($connection, $sms_teacher_query);
        $sms_user_result = mysqli_query($connection, $sms_user_query);

        if (mysqli_errno($connection)) {
            $_SESSION['edit-teacher'] = "Failed to update teacher";
        } else {
            $_SESSION['edit-teacher-success'] = "Teacher $lastname $firstname updated successfully";
        }
}

header('location: ' . ROOT_URL . 'admin/teachers.php');
die();