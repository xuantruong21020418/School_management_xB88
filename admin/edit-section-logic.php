<?php 
require 'config/database.php';
if(isset($_POST['submit'])) {
    //get updated form data
    $section_id = filter_var($_POST['section_id'], FILTER_SANITIZE_NUMBER_INT);
    $section_name = filter_var($_POST['section'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    //check for valid input
    // if(!$firstname || !$lastname || !$admission_no || $admission_date 
    // || $dob || $class || $section || $email || $mobile || $address || $mother_name || $father_name) {
    //     $_SESSION['edit-student'] = "Invalid Form Input on Edit Page";
    // } else {
      //update section
        $query = "UPDATE sms_section SET section='$section_name'
        WHERE section_id = $section_id
        LIMIT 1";

        $result = mysqli_query($connection, $query);

        if (mysqli_errno($connection)) {
            $_SESSION['edit-section'] = "Failed to update Section";
        } else {
            $_SESSION['edit-section-success'] = "Section updated successfully";
        }
    }

header('location: ' . ROOT_URL . 'admin/sections.php');
die();