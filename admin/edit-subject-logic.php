<?php 
require 'config/database.php';
if(isset($_POST['submit'])) {
    //get updated form data
    $subject_id = filter_var($_POST['subject_id'], FILTER_SANITIZE_NUMBER_INT);
    $subject = filter_var($_POST['subject'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $type = $_POST['type'];
    $code = filter_var($_POST['code'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    //check for valid input
    // if(!$firstname || !$lastname || !$admission_no || $admission_date 
    // || $dob || $class || $section || $email || $mobile || $address || $mother_name || $father_name) {
    //     $_SESSION['edit-student'] = "Invalid Form Input on Edit Page";
    // } else {
      //update section
        $query = "UPDATE sms_subjects SET subject='$subject', type='$type', code='$code'
        WHERE subject_id = $subject_id
        LIMIT 1";

        $result = mysqli_query($connection, $query);

        if (mysqli_errno($connection)) {
            $_SESSION['edit-subject'] = "Failed to update Subject";
        } else {
            $_SESSION['edit-subject-success'] = "Subject updated successfully";
        }
    }

header('location: ' . ROOT_URL . 'admin/subjects.php');
die();