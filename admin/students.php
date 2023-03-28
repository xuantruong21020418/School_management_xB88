<?php

use LDAP\Result;

include 'partials/header.php';

$query = "SELECT * FROM sms_students ORDER BY id";
$students = mysqli_query($connection, $query);

//get back form data if there was an error
$firstname = $_SESSION['add-student-data']['firstname'] ?? null;
$lastname = $_SESSION['add-student-data']['lastname'] ?? null;
$admission_no = $_SESSION['add-student-data']['admission_no'] ?? null;
$admission_date = $_SESSION['add-student-data']['admission_date'] ?? null;
$dob = $_SESSION['add-student-data']['dob'] ?? null;
$email = $_SESSION['add-student-data']['email'] ?? null;
$mobile = $_SESSION['add-student-data']['mobile'] ?? null;
$current_address = $_SESSION['add-student-data']['current_address'] ?? null;
$father_name = $_SESSION['add-student-data']['father_name'] ?? null;
$mother_name = $_SESSION['add-student-data']['mother_name'] ?? null;
$createpassword = $_SESSION['add-student-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['add-student-data']['confirmpassword'] ?? null;

//delete session data
unset($_SESSION['add-student-data']);
?>

<section class="dashboard">
<?php if(isset($_SESSION['add-student-success'])) : //shows if add student was successful ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['add-student-success'];
                unset($_SESSION['add-student-success']);
                ?>
            </p>
            </div>
<?php elseif(isset($_SESSION['edit-student-success'])) : //shows if edit student was successful ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['edit-student-success'];
                unset($_SESSION['edit-student-success']);
                ?>
            </p>
            </div>
<?php elseif(isset($_SESSION['edit-student'])) : //shows if edit student was not successful ?>
        <div class="alert__message error container">
            <p>
                <?= $_SESSION['edit-student'];
                unset($_SESSION['edit-student']);
                ?>
            </p>
            </div>
<?php elseif(isset($_SESSION['delete-student-success'])) : //shows if delete student was successful ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['delete-student-success'];
                unset($_SESSION['delete-student-success']);
                ?>
            </p>
            </div>
<?php elseif(isset($_SESSION['delete-student'])) : //shows if delete student was not successful ?>
        <div class="alert__message error container">
            <p>
                <?= $_SESSION['delete-student'];
                unset($_SESSION['delete-student']);
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
                <li><a href="students.php" class="active"><i class="uil uil-users-alt"></i>
                    <h5>Students</h5>
                </a></li>
                <li><a href="sections.php"><i class="uil uil-building"></i>
                    <h5>Sections</h5>
                </a></li>
                <li><a href="teachers.php"><i class="uil uil-users-alt"></i>
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
            <h2>Students</h2>
            <div class="utilities-container">
                <p>
                    <?php if(isset($_SESSION['user_is_admin'])): ?>
                    <button type="submit" name="submit" class="btnLogin-popup"><i class="uil uil-user-plus"></i>Student Admission</button>
                    <?php endif ?>
                    <form class="search__bar-container" action="<?= ROOT_URL ?>admin/student-search-logic.php" method="GET">
                    <div class="search-bar">
                        <i class="uil uil-search"></i>
                        <input type="search" name="student-search" placeholder="Search">
                    </div>
                    <button type="submit" name="submit" class="btn">Go</button>
                    </form>
                </p>
            </div>
            
            <?php if(mysqli_num_rows($students) > 0) : ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>MSSV</th>
						<th>Name</th>
					    <th>Photo</th>
						<th>Class</th>
						<th>Section</th>
                        <?php if(isset($_SESSION['user_is_admin'])): ?>
						<th>Edit</th>
                        <th>Delete</th>
                        <?php endif ?>
                    </tr>
                </thead>
                <tbody>
                    <?php while($student = mysqli_fetch_assoc($students)) : ?>
                    <tr>
                        <td><?= $student['id'] ?></td>
						<td><?= $student['admission_no'] ?></td>
                        <td><?= $student['name'] ?></td>
                        <td>
                            <div class="student-photo">
                                <img src="<?= ROOT_URL . 'images/' . $student['photo'] ?>">
                            </div>
                        </td>
						<td><?= $student['class'] ?></td>
						<td><?= $student['section'] ?></td>
                        <?php if(isset($_SESSION['user_is_admin'])): ?>
                        <td><a href="<?= ROOT_URL ?>admin/edit-user.php?id=<?= $student['id']?>" class="btn sm">Edit</a></td>
                        <td><a href="<?= ROOT_URL ?>admin/delete-student.php?id=<?= $student['id']?>" class="btn sm danger">Delete</a></td>
                        <?php endif ?>
                    </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
            <?php else : ?>
                <div class="alert__message error"><?= "No student found" ?></div>
                <?php endif ?>
        </main>
    </div>
</section>

    <div class="wrapper">
        <span class="icon-close">
            <i class="uil uil-multiply"></i>
        </span>
        <div class="form-box login">
            <h2>Student Admission</h2>
            <?php if(isset($_SESSION['add-student'])): ?>
                <div class="alert__message error">
                    <p>
                        <?= $_SESSION['add-student'];
                        unset($_SESSION['add-student']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form action="<?= ROOT_URL ?>admin/add-student-logic.php" enctype="multipart/form-data" autocomplete="off" method="POST">
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
                    <input type="text" name="admission_no" required autocomplete="new-admission_no"
                    value="<?= $admission_no ?>" placeholder=" ">
                    <label>Admission Number</label>
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
                <label>User Role</label>
                <select name="userrole">
                    <option value="0">Student</option>
                    <option value="1">Admin</option>
                </select>
                <label>Class</label>
                <select name="class">
                    <?php  
                        $all_classes_query = "SELECT * FROM sms_classes";
                        $all_classes = mysqli_query($connection, $all_classes_query);
                    ?>
                    <?php while($class = mysqli_fetch_assoc($all_classes)) : ?>
                        <option value="<?= $class['name'] ?>"><?= $class['name'] ?></option>
                    <?php endwhile ?>
                </select>
                <label>Section</label>
                <select name="section">
                    <?php  
                        $all_sections_query = "SELECT * FROM sms_section";
                        $all_sections = mysqli_query($connection, $all_classes_query);
                    ?>
                    <?php while($class = mysqli_fetch_assoc($all_classes)) : ?>
                        <option value="<?= $class['name'] ?>"><?= $class['name'] ?></option>
                    <?php endwhile ?>
                    <option value="A">A</option>
                    <option value="B">B</option>
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
                    <input type="password" name="createpassword" required autocomplete="new-createpassword"
                    value="<?= $createpassword ?>" placeholder=" ">
                    <label>Create Password</label>
                </div>
                <div class="input-box">
                    <input type="password" name="confirmpassword" required autocomplete="new-confirmpassword"
                    value="<?= $confirmpassword ?>" placeholder=" ">
                    <label>Confirm Password</label>
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
                    <input type="text" name="father_name" required autocomplete="new-father_name"
                    value="<?= $father_name ?>" placeholder=" ">
                    <label>Father Name</label>
                </div>
                <div class="input-box">
                    <input type="text" name="mother_name" required autocomplete="new-mother_name"
                    value="<?= $mother_name ?>" placeholder=" ">
                    <label>Mother Name</label>
                </div>
                
                <button type="submit" name="submit" class="btnSubmit">Save</button>
                
        </div>
    </div>

<?php
include '../partials/footer.php';
?>