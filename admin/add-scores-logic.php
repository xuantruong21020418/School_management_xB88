<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
//get form data if submit button was clicked
    $scores = $_POST['scores'];

    //redirect back if there was any problem
    if(isset($_SESSION['add-score'])) {
        //pass form data back to signup page
        $_SESSION['add-score-data'] = $_POST;
        header('location: ' . ROOT_URL . '/admin/add-scores.php');
        die();
    } else {
        // Insert the score into the database
        foreach ($scores as $student_id => $score) {
            $query = "UPDATE sms_scores SET score = $score WHERE ID = $student_id";
            $result = mysqli_query($connection, $query);
        }

        if (!mysqli_errno($connection)) {
            //redirect to login page with success message
            $_SESSION['add-score-success'] = "New scores added successfully";
            header('location: ' . ROOT_URL . 'admin/scores.php');
            die();
        }
    }
}
