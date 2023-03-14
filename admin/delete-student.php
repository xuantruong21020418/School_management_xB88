<?php
require 'config/database.php';

if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    //fetch user from db
    $query = "SELECT * FROM sms_students WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $student = mysqli_fetch_assoc($result);
    
    //make sure only 1 user retrieved
    if(mysqli_num_rows($result) == 1) {
        $photo_name = $student['photo'];
        $photo_path = '../images/' . $photo_name;
        //delete image if available
        if($photo_path) {
            unlink($photo_path);
        }
    }

    // //for later
    // //fetch all thumbnails of user's posts and delete them
    // $thumbnails_query = "SELECT thumbnail FROM posts WHERE author_id = $id";
    // $thumbnails_result = mysqli_query($connection, $thumbnails_query);
    // if(mysqli_num_rows($thumbnails_result) > 0) {
    //     while($thumbnail = mysqli_fetch_assoc($thumbnails_result)) {
    //         $thumbnail_path = '../images/' . $thumbnail['thumbnail'];
    //         //delete thumbnail from images folder if exist
    //         if($thumbnail_path) {
    //             unlink($thumbnail_path);
    //         }
    //     }
    // }

    //delete user from db
    $delete_student_query = "DELETE FROM sms_students WHERE id=$id";
    $delete_student_result = mysqli_query($connection, $delete_student_query);
    if(mysqli_errno($connection)) {
        $_SESSION['delete-student'] = "Couldn't delete '{$student['name']}'";
    } else {
        $_SESSION['delete-student-success'] = "'{$student['name']}' deleted successfully";
    }
}

header('location: ' . ROOT_URL . 'admin/students.php');
die();