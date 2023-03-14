<?php
require 'config/database.php';

if (isset($_GET['id'])) {
    $subject_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    //fetch subject from db
    $query = "SELECT * FROM sms_subjects WHERE subject_id=$subject_id";
    $result = mysqli_query($connection, $query);

    //make sure only 1 subject was fetched
    if(mysqli_num_rows($result) == 1) {
        $subject = mysqli_fetch_assoc($result);
            //delete subject from db
            $delete_subject_query = "DELETE FROM sms_subjects WHERE subject_id=$subject_id LIMIT 1";
            $delete_subject_result = mysqli_query($connection, $delete_subject_query);

            if (!mysqli_errno($connection)) {
                $_SESSION['delete-subject-success'] = "Subject deleted successfully";
            }
    }
}

header('location: ' . ROOT_URL . 'admin/subjects.php');
die();