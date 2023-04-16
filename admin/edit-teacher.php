<?php
include 'partials/header.php';

if(isset($_GET['email'])) {
    $email = filter_var($_GET['email'], FILTER_SANITIZE_EMAIL);
    $query = "SELECT * FROM sms_teacher WHERE `email` = '$email'";
    $sms_user_query = "SELECT * FROM sms_user WHERE `email` = '$email'";
    $result = mysqli_query($connection, $query);
    $sms_user_result = mysqli_query($connection, $sms_user_query);
    $teacher = mysqli_fetch_assoc($result);
    $user = mysqli_fetch_assoc($sms_user_result);
} else {
    header('location: '. ROOT_URL . 'admin/teachers.php');
    die();
}
?>

        <div class="form-box edit">
            <h2>Edit Teacher</h2>
            <?php if(isset($_SESSION['edit-teacher'])): ?>
                <div class="alert__message error">
                    <p>
                        <?= $_SESSION['edit-teacher'];
                        unset($_SESSION['edit-teacher']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form action="<?= ROOT_URL ?>admin/edit-teacher-logic.php" enctype="multipart/form-data" autocomplete="off" method="POST">
            <div class="input-box">
                    <input type="text" name="firstname" required autocomplete="new-firstname"
                    value="<?= $teacher['firstname'] ?>" placeholder=" ">
                    <label>First Name</label>
                </div>
                <div class="input-box">
                    <input type="text" name="lastname" required autocomplete="new-lastname"
                    value="<?= $teacher['lastname'] ?>" placeholder=" ">
                    <label>Last Name</label>
                </div>
                <div class="input-box">
                    <input type="date" name="admission_date" required autocomplete="new-admission_date"
                    value="<?= $teacher['admission_date'] ?>" placeholder=" ">
                    <label>Admission Date</label>
                </div>
                <div class="input-box">
                    <input type="date" name="dob" required autocomplete="new-dob"
                    value="<?= $teacher['dob'] ?>" placeholder=" ">
                    <label>Date Of Birth</label>
                </div>
                <label>Gender</label>
                <select name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                <label>Class</label>
                <select name="class">
                    <?php  
                        $all_classes_query = "SELECT * FROM sms_classes";
                        $all_classes = mysqli_query($connection, $all_classes_query);
                    ?>
                    <?php while($class = mysqli_fetch_assoc($all_classes)) : ?>
                        <option value="<?= $class['class'] ?>"><?= $class['class'] ?></option>
                    <?php endwhile ?>
                </select>
                <label>Section</label>
                <select name="section">
                    <?php  
                        $all_sections_query = "SELECT * FROM sms_section";
                        $all_sections = mysqli_query($connection, $all_sections_query);
                    ?>
                    <?php while($section = mysqli_fetch_assoc($all_sections)) : ?>
                        <option value="<?= $section['section'] ?>"><?= $section['section'] ?></option>
                    <?php endwhile ?>
                </select>
                <label>Subject</label>
                <select name="subject">
                    <?php  
                        $all_subjects_query = "SELECT * FROM sms_subjects";
                        $all_subjects = mysqli_query($connection, $all_subjects_query);
                    ?>
                    <?php while($subject = mysqli_fetch_assoc($all_subjects)) : ?>
                        <option value="<?= $subject['subject'] ?>"><?= $subject['subject'] ?></option>
                    <?php endwhile ?>
                </select>
                <div class="input-box">
                    <input type="text" name="email" required autocomplete="new-email"
                    value="<?= $teacher['email'] ?>" placeholder=" ">
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <input type="text" name="mobile" required autocomplete="new-mobile"
                    value="<?= $teacher['mobile'] ?>" placeholder=" ">
                    <label>Mobile Number</label>
                </div>
                <label>Address</label>
                <textarea rows="5" name="address" required autocomplete="new-current_address" 
                placeholder=" "><?= $teacher['current_address'] ?></textarea>
                
                <button type="submit" name="submit" class="btnSubmit">Save</button>
            </form>
        </div>

<?php
include '../partials/footer.php';
?>