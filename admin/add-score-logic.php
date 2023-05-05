<?php
require 'config/database.php';

//get form data if submit button was clicked
if(isset($_POST['submit'])) {
    $admission_no = filter_var($_POST['admission_no'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $subject_query = "SELECT subject FROM sms_subjects";
    $result_subject =  mysqli_query($connection, $subject_query);

    while ($subject = mysqli_fetch_all($result_subject, MYSQLI_ASSOC)) {
        
        
    }

    $english = filter_var($_POST['english'], FILTER_SANITIZE_NUMBER_FLOAT);
    $science = filter_var($_POST['science'], FILTER_SANITIZE_NUMBER_FLOAT);
    
    
    // validate input values
    if(!$admission_no) {
        $_SESSION['add-score'] = "Please enter the student's admission number";
    } elseif (!$english) {
      $_SESSION['add-student'] = "Please enter the student's English Point";
    } elseif (!$admission_no) {
        $_SESSION['add-student'] = "Please enter the student's Admission Number";
    } elseif (!$admission_date) {
        $_SESSION['add-student'] = "Please enter the student's Admission Date";
    } elseif (!$dob) {
      $_SESSION['add-student'] = "Please enter the student's Date Of Birth";
    } elseif (!$photo['name']) {
      $_SESSION['add-student'] = "Please add the student's Photo";
    } elseif (!$email) {
      $_SESSION['add-student'] = "Please enter a validate Email";
    } elseif (!$mobile) {
      $_SESSION['add-student'] = "Please enter the student's Mobile Number";
    } elseif (!$address) {
      $_SESSION['add-student'] = "Please enter the student's Address";
    } elseif (!$father_name) {
      $_SESSION['add-student'] = "Please enter the student Father's Name";
    } elseif (!$mother_name) {
      $_SESSION['add-student'] = "Please enter the student Mother's Name";
    } else {
        //check if passwords match
        if($createpassword !== $confirmpassword) {
            $_SESSION['signup'] = "Passwords do not match";
        } else {
            //hash password
            $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);

            //check if username of email already exist in db
            $student_check_query = "SELECT * FROM sms_user WHERE
            'email'='$email'";
            $student_check_result = mysqli_query($connection, $student_check_query);
            if (mysqli_num_rows($student_check_result) > 0) {
                $_SESSION['add-student'] = "Email already taken";
            } else {
                //work on photo
                //rename photo
                $time = time(); // make each image name unique using current timestamp
                $photo_name = $time . $photo['name'];
                $photo_tmp_name = $photo['tmp_name'];
                $photo_destination_path = '../images/' . $photo_name;

                //make sure file is an image
                $allowed_files = ['png', 'jpg', 'jpeg'];
                $extension = explode('.', $photo_name);
                $extension = end($extension);
                if (in_array($extension, $allowed_files)) {
                    //make sure iamge size not too large (3mb+)
                    if ($photo['size'] <= 3145728) {
                        //upload avatar
                        move_uploaded_file($photo_tmp_name, $photo_destination_path);
                    } else {
                        $_SESSION['add-student'] = "File size too big. Should be less than 3mb";
                    }
                } else {
                    $_SESSION['add-student'] = "File should be png, jpg or jpeg";
                }
            }
        }
    }

    //redirect back to signup if there was any problem
    if(isset($_SESSION['add-student'])) {
        //pass form data back to signup page
        $_SESSION['add-student-data'] = $_POST;
        header('location: ' . ROOT_URL . '/admin/students.php');
        die();
    } else {
        //insert new student into users table
        $insert_student_sms_user_query = "INSERT INTO sms_user SET firstname='$firstname', lastname='$lastname', 
        username='$firstname', email='$email', password='$hashed_password', avatar='$photo_name', 
        is_admin=0";
        
        $insert_student_sms_students_query = "INSERT INTO sms_students SET name=CONCAT(' $lastname', '$firstname'), admission_no = '$admission_no',
        email='$email', gender='$gender', dob='$dob', photo='$photo_name', mobile='$mobile', current_address = '$address',
        father_name = '$father_name', mother_name = '$mother_name', class='$class', section='$section', admission_date='$admission_date'";
        
        $insert_student_sms_user_result = mysqli_query($connection, $insert_student_sms_user_query);
        $insert_student_sms_students_result = mysqli_query($connection, $insert_student_sms_students_query);

        if (!mysqli_errno($connection)) {
            //redirect to login page with success message
            $_SESSION['add-student-success'] = "New student $firstname $lastname added successfully";
            header('location: ' . ROOT_URL . 'admin/students.php');
            die();
        }
    }

} else {
    // if button wasn't clicked, bounce back to signup page
    header('location: ' . ROOT_URL . 'admin/students.php');
    die();
}