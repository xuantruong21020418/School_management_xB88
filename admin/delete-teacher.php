<?php
require 'config/database.php';

if (isset($_GET['id'])) {
    $teacher_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    //fetch teacher from db
    $query = "SELECT teacher_id, teacher, subject, name, section
    FROM sms_teacher
    INNER JOIN sms_subjects
    ON sms_teacher.subject_id = sms_subjects.subject_id
    NATURAL JOIN sms_classes
    WHERE teacher_id=$teacher_id";
    $result = mysqli_query($connection, $query);

    //make sure only 1 teacher was fetched
    if(mysqli_num_rows($result) == 1) {
        $teacher = mysqli_fetch_assoc($result);
            //delete teacher from db
            $delete_teacher_query = "DELETE FROM sms_teacher WHERE teacher_id=$teacher_id LIMIT 1";
            $delete_teacher_result = mysqli_query($connection, $delete_teacher_query);
    if(mysqli_errno($connection)) {
        $_SESSION['delete-teacher'] = "Couldn't delete '{$teacher['teacher']}'";
    } else {
        $_SESSION['delete-teacher-success'] = "'{$teacher['teacher']}' deleted successfully";
      }
    }
}

header('location: ' . ROOT_URL . 'admin/teachers.php');
die();