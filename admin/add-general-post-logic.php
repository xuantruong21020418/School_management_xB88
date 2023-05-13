<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
  $title = $_POST['title'];
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
    header('location: ' . ROOT_URL . 'admin/add-general-post.php');
    die();
} else {
        //insert post into db
        $query = "INSERT INTO sms_admin_posts (title, body) VALUES ('$title', '$body')";
        $result = mysqli_query($connection, $query);

        if (!mysqli_errno($connection)) {
            $_SESSION['add-post-success'] = "New post added successfully";
            header('location: ' . ROOT_URL . 'admin/general-notis.php');
            die();
        }
    }