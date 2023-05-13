<?php
require 'config/database.php';

if (isset($_GET['id'])) {
    $post_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    //fetch post from db
    $query = "SELECT * FROM sms_teacher_posts WHERE teacher_post_id=$post_id";
    $result = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($result);

    //make sure only 1 post was fetched
    if(mysqli_num_rows($result) == 1) {
        $delete_post_query = "DELETE FROM sms_teacher_posts WHERE teacher_post_id=$post_id LIMIT 1";
        $delete_post_result = mysqli_query($connection, $delete_post_query);

        if (!mysqli_errno($connection)) {
          $_SESSION['delete-post-success'] = "Post deleted successfully";
          header('location: ' . ROOT_URL . 'admin/single-class.php?id=' . $post['class_id']);
          die();
        }
      }
} else {
    header('location: ' . ROOT_URL . 'admin/single-class.php?id=' . $post['class_id']);
    die();
}

