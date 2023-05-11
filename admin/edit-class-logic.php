<?php 
require 'config/database.php';
if(isset($_POST['submit'])) {
    //get updated form data
    $class_id = filter_var($_POST['class_id'], FILTER_SANITIZE_NUMBER_INT);
    $class = filter_var($_POST['class'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $section = $_POST['section'];

      //update section
        $query = "UPDATE sms_classes SET class='$class', section='$section'
        WHERE class_id = $class_id
        LIMIT 1";

        $result = mysqli_query($connection, $query);

        if (mysqli_errno($connection)) {
            $_SESSION['edit-class'] = "Failed to update class";
        } else {
            $_SESSION['edit-class-success'] = "Class updated successfully";
        }
    }

header('location: ' . ROOT_URL . 'admin/classes.php');
die();