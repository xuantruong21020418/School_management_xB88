<?php

use LDAP\Result;

include 'partials/header.php';

$query = "SELECT teacher_id, teacher, subject, name, section FROM sms_teacher
INNER JOIN sms_subjects
ON sms_teacher.subject_id = sms_subjects.subject_id
NATURAL JOIN sms_classes
ORDER BY teacher_id";
$teachers = mysqli_query($connection, $query);
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
				<li><a href="classes.php"><i class="uil uil-postcard"></i></i>
                    <h5>Classes</h5>
                </a></li>
                <?php if(isset($_SESSION['user_is_admin'])): ?>
                <li><a href="students.php"><i class="uil uil-user-plus"></i></i>
                    <h5>Students</h5>
                </a></li>
                <li><a href="sections.php"><i class="uil uil-users-alt"></i></i>
                    <h5>Sections</h5>
                </a></li>
                <li><a href="teachers.php" class="active"><i class="uil uil-edit"></i>
                    <h5>Teachers</h5>
                </a></li>
                <li><a href="subjects.php"><i class="uil uil-list-ul"></i></i>
                    <h5>Subjects</h5>
                </a></li>
                <li><a href="attendance.php"><i class="uil uil-list-ul"></i></i>
                    <h5>Attendance</h5>
                </a></li>
                <li><a href="attendance-reports.php"><i class="uil uil-list-ul"></i></i>
                    <h5>Attendance Reports</h5>
                </a></li>
                <?php endif ?>
            </ul>
        </aside>
        <main>
            <h2>Teachers</h2>
            <div class="container utilities-container">
            <button name="student-pop-up" class="btn pop">Add New Teacher</button>
            <section class="search__bar">
            <form class="container search__bar-container" action="<?= ROOT_URL ?>search.php" method="GET">
                <div>
                    <i class="uil uil-search"></i>
                    <input type="search" name="search" placeholder="Search">
                </div>
                <button type="submit" name="submit" class="btn">Go</button>
            </form>
            </section>
            </div>
            
            <?php if(mysqli_num_rows($teachers) > 0) : ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
						<th>Name</th>
                        <th>Assigned Subjects</th>
						<!-- <th>Photo</th> -->
						<th>Class</th>
						<th>Section</th>
						<th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($teacher = mysqli_fetch_assoc($teachers)) : ?>
                    <tr>
                        <td><?= $teacher['teacher_id'] ?></td>
						<td><?= $teacher['teacher'] ?></td>
                        <td><?= $teacher['subject'] ?></td>
						<td><?= $teacher['name'] ?></td>
						<td><?= $teacher['section'] ?></td>
                        <td><a href="<?= ROOT_URL ?>admin/edit-user.php?id=<?= $teacher['teacher_id']?>" class="btn sm">Edit</a></td>
                        <td><a href="<?= ROOT_URL ?>admin/delete-teacher.php?id=<?= $teacher['teacher_id']?>" class="btn sm danger">Delete</a></td>
                    </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
            <?php else : ?>
                <div class="alert__message error"><?= "No teachers found" ?></div>
                <?php endif ?>
        </main>
    </div>
</section>

<?php
include '../partials/footer.php';
?>