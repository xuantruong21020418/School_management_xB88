<?php
require 'config/database.php';

//get form data if submit button was clicked
if(isset($_POST['submit'])) {
  $class_name = filter_var($_POST['class'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $section_name = $_POST['section'];
    
    // validate input values
    if(!$class_name) {
      $_SESSION['add-class'] = "Please enter the class Name";
    } else if (!$section_name) {
      $_SESSION['add-class'] = "Please enter the class's Section";
    } else {
            //check if class already exist in db
            $class_check_query = "SELECT * FROM sms_classes WHERE
            class LIKE '$class_name'";
            $class_check_result = mysqli_query($connection, $class_check_query);
            if (mysqli_num_rows($class_check_result) > 0) {
              $_SESSION['add-class'] = "Class's already existed";             
            }
    }

    //redirect back to signup if there was any problem
    if(isset($_SESSION['add-class'])) {
        //pass form data back to signup page
        $_SESSION['add-class-data'] = $_POST;
        header('location: ' . ROOT_URL . '/admin/classes.php');
        die();
    } else {
        $thumbnails = array("thumbnail1.jpg", "thumbnail2.jpg", "thumbnail3.jpg", "thumbnail4.jpg", "thumbnail5.jpg",
        "thumbnail6.jpg", "thumbnail7.jpg", "thumbnail8.jpg", "thumbnail9.jpg", "thumbnail10.jpg", "thumbnail11.jpg");
        $thumbnail = array_rand($thumbnails, 1);
        //insert new class into classs table
        $insert_class_query = "INSERT INTO sms_classes SET class='$class_name', section='$section_name', thumbnail='$thumbnails[$thumbnail]'";
        
        $insert_class_result = mysqli_query($connection, $insert_class_query);

        if (!mysqli_errno($connection)) {
            //redirect to login page with success message
            $_SESSION['add-class-success'] = "New class added successfully";
            header('location: ' . ROOT_URL . 'admin/classes.php');
            die();
        }
    }

} else {
    // if button wasn't clicked, bounce back to signup page
    header('location: ' . ROOT_URL . 'admin/classes.php');
    die();
}