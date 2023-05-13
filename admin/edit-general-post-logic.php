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
    $query = "SELECT * FROM sms_admin_posts WHERE admin_post_id = $post_id";
    $result = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($result);
//redirect back (with form data) to edit-post page if there is any problem
if(isset($_SESSION['edit-post'])) {
    
    $_SESSION['edit-post-data'] = $_POST;
    header('location: ' . ROOT_URL . 'admin/edit-general-post.php?id=' . $post['admin_post_id']);
    die();
} else {
        //update post indb
        $query = "UPDATE sms_admin_posts SET title = '$title', body = '$body', updated_at = NOW() WHERE admin_post_id = $post_id LIMIT 1";
        $result = mysqli_query($connection, $query);

        if (!mysqli_errno($connection)) {
            $_SESSION['edit-post-success'] = "Post edited successfully";
            header('location: ' . ROOT_URL . 'admin/general-notis.php');
            die();
        }
    }