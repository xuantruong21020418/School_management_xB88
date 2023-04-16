<?php 
require 'config/database.php';
if(isset($_POST['submit'])) {
    //get updated form data
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $admission_no = filter_var($_POST['admission_no'], FILTER_SANITIZE_NUMBER_INT);
    $admission_date = filter_var($_POST['admission_date'], FILTER_SANITIZE_NUMBER_INT);
    $dob = filter_var($_POST['dob'], FILTER_SANITIZE_NUMBER_INT);
    $class = $_POST['class'];
    $section = $_POST['section'];
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $mobile = filter_var($_POST['mobile'], FILTER_SANITIZE_NUMBER_INT);
    $address = filter_var($_POST['address'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $father_name = filter_var($_POST['father_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $mother_name = filter_var($_POST['mother_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    //check for valid input
    // if(!$firstname || !$lastname || !$admission_no || $admission_date 
    // || $dob || $class || $section || $email || $mobile || $address || $mother_name || $father_name) {
    //     $_SESSION['edit-student'] = "Invalid Form Input on Edit Page";
    // } else {
      //update user
        $sms_user_query = "UPDATE sms_user SET firstname='$firstname', lastname='$lastname'
        WHERE email='$email'
        LIMIT 1";

      //update student
        $sms_student_query = "UPDATE sms_students SET name=CONCAT(' $lastname', ' $firstname'), admission_no = '$admission_no',
        email='$email', dob='$dob', mobile='$mobile', current_address = '$address',
        father_name = '$father_name', mother_name = '$mother_name', class='$class', 
        section='$section', admission_date='$admission_date' 
        WHERE `email` = '$email'
        LIMIT 1";

        $sms_student_result = mysqli_query($connection, $sms_student_query);
        $sms_user_result = mysqli_query($connection, $sms_user_query);

        if (mysqli_errno($connection)) {
            $_SESSION['edit-student'] = "Failed to update student";
        } else {
            $_SESSION['edit-student-success'] = "Student $lastname $firstname updated successfully";
        }
    // }
}

header('location: ' . ROOT_URL . 'admin/students.php');
die();