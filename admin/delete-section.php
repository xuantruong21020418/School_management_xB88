<?php
require 'config/database.php';

if (isset($_GET['id'])) {
    $section_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    //fetch section from db
    $query = "SELECT section_id, section FROM sms_section WHERE section_id=$section_id";
    $result = mysqli_query($connection, $query);

    //make sure only 1 section was fetched
    if(mysqli_num_rows($result) == 1) {
        $section = mysqli_fetch_assoc($result);
            //delete section from db
            $delete_section_query = "DELETE FROM sms_section WHERE section_id=$section_id LIMIT 1";
            $delete_section_result = mysqli_query($connection, $delete_section_query);

            if (!mysqli_errno($connection)) {
                $_SESSION['delete-section-success'] = "Section deleted successfully";
            }
    }
}

header('location: ' . ROOT_URL . 'admin/sections.php');
die();