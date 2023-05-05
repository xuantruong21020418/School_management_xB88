<?php
require 'partials/header.php';

if (isset($_GET['student-search']) && isset($_GET['submit'])) {
    $search = filter_var($_GET['student-search'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $query = "SELECT * FROM sms_students WHERE admission_no = $search";
    $students = mysqli_query($connection, $query);
} else {
    header('location: ' . ROOT_URL . 'admin/students.php');
    die();
}
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
				<li><a href="classes.php"><i class="uil uil-postcard"></i></i>
                <h5>Classes</h5>
                </a></li>
                <?php if(isset($_SESSION['user_is_admin'])): ?>
                <li><a href="students.php" class="active"><i class="uil uil-user-plus"></i></i>
                    <h5>Students</h5>
                </a></li>
                <li><a href="sections.php"><i class="uil uil-users-alt"></i></i>
                    <h5>Sections</h5>
                </a></li>
                <li><a href="scores.php"><i class="uil uil-edit"></i>
                    <h5>Scores</h5>
                </a></li>
                <li><a href="teachers.php"><i class="uil uil-edit"></i>
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
        <h2>Students</h2>
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
					<th>Edit</th>
                        <th>Delete</th>
                </tr>
            </thead>
          <tbody>
            <?php while ($student = mysqli_fetch_assoc($students)) : ?>
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
                <td><a href="<?= ROOT_URL ?>admin/edit-user.php?id=<?= $student['id']?>" class="btn sm">Edit</a></td>
                <td><a href="<?= ROOT_URL ?>admin/delete-student.php?email=<?= $student['email']?>" class="btn sm danger">Delete</a></td>
              </tr>
            <?php endwhile ?>
          </tbody>
        </table>
        <?php else : ?>
            <div class="alert__message error lg section_extra-margin"><p>No student found.</p></div>
        <?php endif ?>
      </main>
</div>
</section>

<?php
include '../partials/footer.php';
?>