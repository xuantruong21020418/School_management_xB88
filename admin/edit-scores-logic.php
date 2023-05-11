<?php 
require 'config/database.php';
if(isset($_POST['submit'])) {
    //get updated form data
    $score_id = filter_var($_POST['score_id'], FILTER_SANITIZE_NUMBER_INT);
    $admission_no = filter_var($_POST['admission_no'], FILTER_SANITIZE_NUMBER_INT);
    $fullname = filter_var($_POST['fullname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $score = filter_var($_POST['score'], FILTER_SANITIZE_NUMBER_INT);

    //check for valid input
    // if(!$firstname || !$lastname || !$admission_no || $admission_date 
    // || $dob || $class || $section || $email || $mobile || $address || $mother_name || $father_name) {
    //     $_SESSION['edit-student'] = "Invalid Form Input on Edit Page";
    // } else {
      //update section
        $query = "UPDATE sms_scores SET admission_no=$admission_no, name='$fullname', score=$score
        WHERE ID = $score_id
        LIMIT 1";

        $result = mysqli_query($connection, $query);

        if (mysqli_errno($connection)) {
            $_SESSION['edit-score'] = "Failed to update Score";
        } else {
            $_SESSION['edit-score-success'] = "Score updated successfully";
        }
    }

header('location: ' . ROOT_URL . 'admin/scores.php');
die();