<?php

use LDAP\Result;

include 'partials/header.php';

$query = "SELECT teacher_id, firstname, subject, class, section, email FROM sms_teacher
NATURAL JOIN sms_subjects
NATURAL JOIN sms_classes
NATURAL JOIN sms_section
ORDER BY teacher_id";
$teachers = mysqli_query($connection, $query);

//get back form data if there was an error
$firstname = $_SESSION['add-teacher-data']['firstname'] ?? null;
$lastname = $_SESSION['add-teacher-data']['lastname'] ?? null;
$admission_date = $_SESSION['add-teacher-data']['admission_date'] ?? null;
$dob = $_SESSION['add-teacher-data']['dob'] ?? null;
$email = $_SESSION['add-teacher-data']['email'] ?? null;
$mobile = $_SESSION['add-teacher-data']['mobile'] ?? null;
$current_address = $_SESSION['add-teacher-data']['current_address'] ?? null;
$createpassword = $_SESSION['add-teacher-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['add-teacher-data']['confirmpassword'] ?? null;

//delete session data
unset($_SESSION['add-teacher-data']);
?>

<section class="dashboard">
<?php if(isset($_SESSION['add-teacher-success'])) : //shows if add teacher was successful ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['add-teacher-success'];
                unset($_SESSION['add-teacher-success']);
                ?>
            </p>
            </div>
<?php elseif(isset($_SESSION['edit-teacher-success'])) : //shows if edit teacher was successful ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['edit-teacher-success'];
                unset($_SESSION['edit-teacher-success']);
                ?>
            </p>
            </div>
<?php elseif(isset($_SESSION['edit-teacher'])) : //shows if edit teacher was not successful ?>
        <div class="alert__message error container">
            <p>
                <?= $_SESSION['edit-teacher'];
                unset($_SESSION['edit-teacher']);
                ?>
            </p>
            </div>
<?php elseif(isset($_SESSION['delete-teacher-success'])) : //shows if delete teacher was successful ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['delete-teacher-success'];
                unset($_SESSION['delete-teacher-success']);
                ?>
            </p>
            </div>
<?php elseif(isset($_SESSION['delete-teacher'])) : //shows if delete teacher was not successful ?>
        <div class="alert__message error container">
            <p>
                <?= $_SESSION['delete-teacher'];
                unset($_SESSION['delete-teacher']);
                ?>
            </p>
            </div>
            <?php endif ?>
    <div class="container dashboard__container">
        <button id="show__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-left-b"></i></button>
        
        <aside>
            <ul>
				<li><a href="classes.php"><i class="uil uil-presentation-edit"></i>
                    <h5>Classes</h5>
                </a></li>
                <li><a href="students.php"><i class="uil uil-users-alt"></i>
                    <h5>Students</h5>
                </a></li>
                <li><a href="sections.php"><i class="uil uil-building"></i>
                    <h5>Sections</h5>
                </a></li>
                <li><a href="score.php"><i class="uil uil-edit"></i>
                    <h5>Score</h5>
                </a></li>
                <li><a href="teachers.php" class="active"><i class="uil uil-users-alt"></i>
                    <h5>Teachers</h5>
                </a></li>
                <li><a href="subjects.php"><i class="uil uil-edit"></i>
                    <h5>Subjects</h5>
                </a></li>
                <li><a href="attendance.php"><i class="uil uil-calendar-alt"></i>
                    <h5>Attendance</h5>
                </a></li>
                <?php if(isset($_SESSION['user_is_admin'])): ?>
                <li><a href="attendance-reports.php"><i class="uil uil-analytics"></i>
                    <h5>Attendance Reports</h5>
                </a></li>
                <?php endif ?>
            </ul>
        </aside>
        <main>
            <h2>Teachers</h2>
            <div class="utilities-container">
                <p>
                    <?php if(isset($_SESSION['user_is_admin'])): ?>
                    <button name="teacher-pop-up" class="btnLogin-popup"><i class="uil uil-user-plus"></i>Add New Teacher</button>
                    <?php endif ?>
                    <form class="search__bar-container" action="<?= ROOT_URL ?>admin/teacher-search-logic.php" method="GET">
                    <div class="search-bar">
                        <i class="uil uil-search"></i>
                        <input type="search" name="teacher-search" placeholder="Search">
                    </div>
                    <button type="submit" name="submit" class="btn">Go</button>
                    </form>
                </p>
            </div>
            
            <?php if(mysqli_num_rows($teachers) > 0) : ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
						<th>Name</th>
                        <th>Assigned Subject</th>
						<th>Class</th>
						<th>Section</th>
                        <?php if(isset($_SESSION['user_is_admin'])): ?>
						<th>Edit</th>
                        <th>Delete</th>
                        <?php endif ?>
                    </tr>
                </thead>
                <tbody>
                    <?php while($teacher = mysqli_fetch_assoc($teachers)) : ?>
                    <tr>
                        <td><?= $teacher['teacher_id'] ?></td>
						<td><?= $teacher['firstname'] ?></td>
                        <td><?= $teacher['subject'] ?></td>
						<td><?= $teacher['class'] ?></td>
						<td><?= $teacher['section'] ?></td>
                        <?php if(isset($_SESSION['user_is_admin'])): ?>
                        <td><a href="<?= ROOT_URL ?>admin/edit-teacher.php?email=<?= $teacher['email']?>" class="btn sm">Edit</a></td>
                        <td><a href="<?= ROOT_URL ?>admin/delete-teacher.php?email=<?= $teacher['email']?>" class="btn sm danger">Delete</a></td>
                        <?php endif ?>
                    </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
            <?php else : ?>
                <div class="alert__message error"><?= "No teacher found." ?></div>
                <?php endif ?>
        </main>
    </div>
</section>

    <div class="wrapper">
        <span class="icon-close">
            <i class="uil uil-multiply"></i>
        </span>
        <div class="form-box login">
            <h2>Add New Teacher</h2>
            <?php if(isset($_SESSION['add-teacher'])): ?>
                <div class="alert__message error">
                    <p>
                        <?= $_SESSION['add-teacher'];
                        unset($_SESSION['add-teacher']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form action="<?= ROOT_URL ?>admin/add-teacher-logic.php" enctype="multipart/form-data" autocomplete="off" method="POST">
                <div class="input-box">
                    <input type="text" name="firstname" required autocomplete="new-firstname"
                    value="<?= $firstname ?>" placeholder=" ">
                    <label>First Name</label>
                </div>
                <div class="input-box">
                    <input type="text" name="lastname" required autocomplete="new-lastname"
                    value="<?= $lastname ?>" placeholder=" ">
                    <label>Last Name</label>
                </div>
                <div class="input-box">
                    <input type="date" name="admission_date" required autocomplete="new-admission_date"
                    value="<?= $admission_date ?>" placeholder=" ">
                    <label>Admission Date</label>
                </div>
                <div class="input-box">
                    <input type="date" name="dob" required autocomplete="new-dob"
                    value="<?= $dob ?>" placeholder=" ">
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
                <label for="avatar">Photo</label>
                <div class="form__control">
                    <input type="file" name="photo" id="photo">
                </div>
                <div class="input-box">
                    <input type="text" name="email" required autocomplete="new-email"
                    value="<?= $email ?>" placeholder=" ">
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <input type="text" name="mobile" required autocomplete="new-mobile"
                    value="<?= $mobile ?>" placeholder=" ">
                    <label>Mobile Number</label>
                </div>
                <label>Address</label>
                <textarea rows="5" name="address" required autocomplete="new-current_address" 
                placeholder=" "><?= $current_address ?></textarea>
                <div class="input-box">
                    <input type="password" name="createpassword" required autocomplete="new-createpassword"
                    value="<?= $createpassword ?>" placeholder=" ">
                    <label>Create Password</label>
                </div>
                <div class="input-box">
                    <input type="password" name="confirmpassword" required autocomplete="new-confirmpassword"
                    value="<?= $confirmpassword ?>" placeholder=" ">
                    <label>Confirm Password</label>
                </div>
                <button type="submit" name="submit" class="btnSubmit">Save</button>
                
        </div>
    </div>

<?php
include '../partials/footer.php';
?>