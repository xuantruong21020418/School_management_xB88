<?php
require 'config/database.php';

//get form data if submit button was clicked
if(isset($_POST['submit'])) {
  $subject_name = filter_var($_POST['subject'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $type = $_POST['type'];
  $code = filter_var($_POST['code'], FILTER_SANITIZE_NUMBER_INT);
    
    // validate input values
    if(!$subject_name) {
      $_SESSION['add-subject'] = "Please enter the Subject Name";
    } else if (!$code) {
      $_SESSION['add-subject'] = "Please enter the Subject Code";
    } else {
            //check if subject already exist in db
            $subject_check_query = "SELECT * FROM sms_subjects WHERE
            subject = '$subject_name' AND type LIKE '$type'";
            $subject_check_result = mysqli_query($connection, $subject_check_query);
            if (mysqli_num_rows($subject_check_result) > 0) {
              $_SESSION['add-subject'] = "Subject's already existed";             
            }
    }

    //redirect back to signup if there was any problem
    if(isset($_SESSION['add-subject'])) {
        //pass form data back to signup page
        $_SESSION['add-subject-data'] = $_POST;
        header('location: ' . ROOT_URL . '/admin/subjects.php');
        die();
    } else {
        //insert new subject into subjects table
        $insert_subject_query = "INSERT INTO sms_subjects SET subject='$subject_name', type='$type', code='$code'";
        
        $insert_subject_result = mysqli_query($connection, $insert_subject_query);

        if (!mysqli_errno($connection)) {
            //redirect to login page with success message
            $_SESSION['add-subject-success'] = "New subject added successfully";
            header('location: ' . ROOT_URL . 'admin/subjects.php');
            die();
        }
    }

} else {
    // if button wasn't clicked, bounce back to signup page
    header('location: ' . ROOT_URL . 'admin/subjects.php');
    die();
}