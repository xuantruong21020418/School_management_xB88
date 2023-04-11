<?php
require 'config/database.php';

//get form data if submit button was clicked
if(isset($_POST['submit'])) {
    $section_name = filter_var($_POST['section'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    
    // validate input values
    if(!$section_name) {
        $_SESSION['add-section'] = "Please enter the Section Name";
    } else {
            //check if section already exist in db
            $section_check_query = "SELECT * FROM sms_section WHERE
            section LIKE '$section_name'";
            $section_check_result = mysqli_query($connection, $section_check_query);
            if (mysqli_num_rows($section_check_result) > 0) {
                $_SESSION['add-section'] = "Section's already existed";
            }
    }

    //redirect back to signup if there was any problem
    if(isset($_SESSION['add-section'])) {
        //pass form data back to signup page
        $_SESSION['add-section-data'] = $_POST;
        header('location: ' . ROOT_URL . '/admin/sections.php');
        die();
    } else {
        //insert new section into sections table
        $insert_section_query = "INSERT INTO sms_section SET section='$section_name'";
        
        $insert_section_result = mysqli_query($connection, $insert_section_query);

        if (!mysqli_errno($connection)) {
            //redirect to login page with success message
            $_SESSION['add-section-success'] = "New section added successfully";
            header('location: ' . ROOT_URL . 'admin/sections.php');
            die();
        }
    }

} else {
    // if button wasn't clicked, bounce back to signup page
    header('location: ' . ROOT_URL . 'admin/sections.php');
    die();
}