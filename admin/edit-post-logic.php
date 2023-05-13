<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
  $post_id = filter_var($_POST['post_id'], FILTER_SANITIZE_NUMBER_INT);
  $title = $_POST['title'];
  $body = $_POST['body'];
}

    //validate form data
    if(!$title) {
        $_SESSION['edit-post'] = "Enter post title";
    } elseif(!$body) {
        $_SESSION['edit-post'] = "Enter post body";
    } 
    $query = "SELECT teacher_id, class_id FROM sms_teacher_posts WHERE teacher_post_id = $post_id";
    $result = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($result);
//redirect back (with form data) to edit-post page if there is any problem
if(isset($_SESSION['edit-post'])) {
    
    $_SESSION['edit-post-data'] = $_POST;
    header('location: ' . ROOT_URL . 'admin/edit-post.php?id=' . $post['class_id']);
    die();
} else {
        //update post indb
        $query = "UPDATE sms_teacher_posts SET title = '$title', body = '$body', updated_at = NOW() WHERE teacher_post_id = $post_id LIMIT 1";
        $result = mysqli_query($connection, $query);

        if (!mysqli_errno($connection)) {
            $_SESSION['edit-post-success'] = "Post edited successfully";
            header('location: ' . ROOT_URL . 'admin/single-class.php?id=' . $post['class_id']);
            die();
        }
    }