<?php

use LDAP\Result;

include 'partials/header.php';

$query = "SELECT * FROM sms_subjects ORDER BY subject_id";
$subjects = mysqli_query($connection, $query);
?>

<section class="dashboard">
<?php if(isset($_SESSION['add-subject-success'])) : //shows if add subject was successful ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['add-subject-success'];
                unset($_SESSION['add-subject-success']);
                ?>
            </p>
            </div>
<?php elseif(isset($_SESSION['edit-subject-success'])) : //shows if edit subject was successful ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['edit-subject-success'];
                unset($_SESSION['edit-subject-success']);
                ?>
            </p>
            </div>
<?php elseif(isset($_SESSION['edit-subject'])) : //shows if edit subject was not successful ?>
        <div class="alert__message error container">
            <p>
                <?= $_SESSION['edit-subject'];
                unset($_SESSION['edit-subject']);
                ?>
            </p>
            </div>
<?php elseif(isset($_SESSION['delete-subject-success'])) : //shows if delete subject was successful ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['delete-subject-success'];
                unset($_SESSION['delete-subject-success']);
                ?>
            </p>
            </div>
<?php elseif(isset($_SESSION['delete-subject'])) : //shows if delete subject was not successful ?>
        <div class="alert__message error container">
            <p>
                <?= $_SESSION['delete-subject'];
                unset($_SESSION['delete-subject']);
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
                <li><a href="teachers.php"><i class="uil uil-edit"></i>
                    <h5>Teachers</h5>
                </a></li>
                <li><a href="subjects.php" class="active"><i class="uil uil-list-ul"></i></i>
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
            <h2>Subjects</h2>
            <div class="container utilities-container">
            <button name="student-pop-up" class="btn pop">Add New Subject</button>
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
            
            <?php if(mysqli_num_rows($subjects) > 0) : ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
						<th>Subject</th>
						<!-- <th>Photo</th> -->
						<th>Code</th>
                        <th>Subject Type</th>
						<th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($subject = mysqli_fetch_assoc($subjects)) : ?>
                    <tr>
                        <td><?= $subject['subject_id'] ?></td>
												<td><?= $subject['subject'] ?></td>
                        <td><?= $subject['code'] ?></td>
                        <td><?= $subject['type'] ?></td>
                        <td><a href="<?= ROOT_URL ?>admin/edit-user.php?id=<?= $subject['subject_id']?>" class="btn sm">Edit</a></td>
                        <td><a href="<?= ROOT_URL ?>admin/delete-subject.php?id=<?= $subject['subject_id']?>" class="btn sm danger">Delete</a></td>
                    </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
            <?php else : ?>
                <div class="alert__message error"><?= "No subjects found" ?></div>
                <?php endif ?>
        </main>
    </div>
</section>

<?php
include '../partials/footer.php';
?>