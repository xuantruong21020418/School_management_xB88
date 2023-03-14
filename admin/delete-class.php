<?php
require 'config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    //fetch class from db
    $query = "SELECT * FROM sms_classes WHERE id=$id";
    $result = mysqli_query($connection, $query);

    //make sure only 1 class was fetched
    if(mysqli_num_rows($result) == 1) {
        $class = mysqli_fetch_assoc($result);
            //delete class from db
            $delete_class_query = "DELETE FROM sms_classes WHERE id=$id LIMIT 1";
            $delete_class_result = mysqli_query($connection, $delete_class_query);

            if (!mysqli_errno($connection)) {
                $_SESSION['delete-class-success'] = "Class deleted successfully";
            }
    }
}

header('location: ' . ROOT_URL . 'admin/classes.php');
die();