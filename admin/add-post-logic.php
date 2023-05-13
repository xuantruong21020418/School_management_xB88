<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
  $author_id = $_SESSION['user-id'];
  $title = $_POST['title'];
  $class_id = $_POST['class_id'];
  $body = $_POST['body'];
  // echo $author_id . "<br>" . $class_id . "<br>" . $title . "<br>" . $body . "<br>" . $photo['name'] . "<br>";
}

    //validate form data
    if(!$title) {
        $_SESSION['add-post'] = "Enter post title";
    } elseif(!$body) {
        $_SESSION['add-post'] = "Enter post body";
    }
    
//redirect back (with form data) to add-post page if there is any problem
if(isset($_SESSION['add-post'])) {
    $_SESSION['add-post-data'] = $_POST;
    header('location: ' . ROOT_URL . 'admin/add-post.php?id=' . $class_id);
    die();
} else {
        //insert post into db
        $query = "INSERT INTO sms_teacher_posts (title, body, class_id, teacher_id) VALUES ('$title', '$body', $class_id, $author_id)";
        $result = mysqli_query($connection, $query);

        if (!mysqli_errno($connection)) {
            $_SESSION['add-post-success'] = "New post added successfully";
            header('location: ' . ROOT_URL . 'admin/single-class.php?id=' . $class_id);
            die();
        }
    }