<?php
require 'config/database.php';

//get form data if submit button was clicked
if(isset($_POST['submit'])) {
  $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $admission_date = filter_var($_POST['admission_date'], FILTER_SANITIZE_NUMBER_INT);
  $dob = filter_var($_POST['dob'], FILTER_SANITIZE_NUMBER_INT);
  $gender = filter_var($_POST['gender'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $class = $_POST['class'];
  $section = $_POST['section'];
  $photo = $_FILES['photo'];
  $subject = $_POST['subject'];
  $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
  $mobile = filter_var($_POST['mobile'], FILTER_SANITIZE_NUMBER_INT);
  $address = filter_var($_POST['address'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $createpassword = $_POST['createpassword'];
  $confirmpassword = $_POST['confirmpassword'];
    
    
    // validate input values
    if(!$firstname) {
        $_SESSION['add-teacher'] = "Please enter the teacher's First Name";
    } elseif (!$lastname) {
      $_SESSION['add-teacher'] = "Please enter the teacher's Last Name";
    } elseif (!$admission_date) {
        $_SESSION['add-teacher'] = "Please enter the teacher's Admission Date";
    } elseif (!$dob) {
      $_SESSION['add-teacher'] = "Please enter the teacher's Date Of Birth";
    } elseif (!$photo['name']) {
      $_SESSION['add-teacher'] = "Please add the teacher's Photo";
    } elseif (!$email) {
      $_SESSION['add-teacher'] = "Please enter a validate Email";
    } elseif (!$mobile) {
      $_SESSION['add-teacher'] = "Please enter the teacher's Mobile Number";
    } elseif (!$address) {
      $_SESSION['add-teacher'] = "Please enter the teacher's Address";
    } else {
      // echo $firstname . "<br>";
      // echo $lastname . "<br>";
      // echo $admission_date . "<br>";
      // echo $dob . "<br>";
      // echo $gender . "<br>";
      // echo $class . "<br>";
      // echo $section. "<br>";
      // echo $subject . "<br>";
      // echo $email . "<br>";
      // echo $mobile . "<br>";
      // echo $address . "<br>";
      // echo $createpassword . "<br>";
      // echo $confirmpassword;
        //check if passwords match
        if($createpassword !== $confirmpassword) {
            $_SESSION['signup'] = "Passwords do not match";
        } else {
            //hash password
            $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);

            //check if username of email already exist in db
            $teacher_check_query = "SELECT * FROM sms_teacher WHERE
            'email'='$email'";
            $teacher_check_result = mysqli_query($connection, $teacher_check_query);
            if (mysqli_num_rows($teacher_check_result) > 0) {
                $_SESSION['add-teacher'] = "Email already taken";
            } else {
              $teacher_classes_query = "SELECT class, subject FROM sms_teacher";
              $teacher_classes_result = mysqli_query($connection, $teacher_classes_query);
              while ($teacher_class_result = mysqli_fetch_assoc($teacher_classes_result)) {
                if ($class == $teacher_class_result['class'] && $subject == $teacher_class_result['subject']) {
                  $_SESSION['add-teacher'] = "Another teacher has teached this subject in this class.";
                }
              }
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
                        $_SESSION['add-teacher'] = "File size too big. Should be less than 3mb";
                    }
                } else {
                    $_SESSION['add-teacher'] = "File should be png, jpg or jpeg";
                }
            }
        }
    }

    //redirect back to signup if there was any problem
    if(isset($_SESSION['add-teacher'])) {
        //pass form data back to signup page
        $_SESSION['add-teacher-data'] = $_POST;
        header('location: ' . ROOT_URL . '/admin/teachers.php');
        die();
    } else {
        //insert new teacher into users table
        $insert_teacher_sms_user_query = "INSERT INTO sms_user SET firstname='$firstname', lastname='$lastname', 
        username='$firstname', email='$email', password='$hashed_password', avatar='$photo_name', 
        is_admin=1";
        
        $insert_teacher_sms_teachers_query = "INSERT INTO sms_teacher SET firstname='$firstname', lastname='$lastname',
        email='$email', gender='$gender', dob='$dob', photo='$photo_name', mobile='$mobile', current_address = '$address',
        class='$class', section='$section', admission_date='$admission_date', subject='$subject'";
        
        $insert_teacher_sms_user_result = mysqli_query($connection, $insert_teacher_sms_user_query);
        $insert_teacher_sms_teachers_result = mysqli_query($connection, $insert_teacher_sms_teachers_query);

        if (!mysqli_errno($connection)) {
            //redirect to login page with success message
            $_SESSION['add-teacher-success'] = "New teacher $firstname $lastname added successfully";
            header('location: ' . ROOT_URL . 'admin/teachers.php');
            die();
        }
    }

} else {
    // if button wasn't clicked, bounce back to signup page
    header('location: ' . ROOT_URL . 'admin/teachers.php');
    die();
}