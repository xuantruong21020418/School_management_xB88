<?php
require 'partials/header.php';

if (isset($_GET['subject-search']) && isset($_GET['submit'])) {
    $search = filter_var($_GET['subject-search'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $query = "SELECT * FROM sms_subjects
    WHERE subject LIKE '%$search%' ORDER BY subject_id";
    $subjects = mysqli_query($connection, $query);
} else {
    header('location: ' . ROOT_URL . 'admin/subjects.php');
    die();
}
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
            <?php if(isset($_SESSION['user_is_admin'])): ?>
				        <li><a href="classes.php"><i class="uil uil-presentation-edit"></i>
                    <h5>Classes</h5>
                </a></li>
                <li><a href="students.php"><i class="uil uil-users-alt"></i>
                    <h5>Students</h5>
                </a></li>
                <li><a href="sections.php"><i class="uil uil-building"></i>
                    <h5>Sections</h5>
                </a></li>
                <li><a href="scores.php"><i class="uil uil-edit"></i>
                    <h5>Scores</h5>
                </a></li>
                <li><a href="teachers.php"><i class="uil uil-users-alt"></i>
                    <h5>Teachers</h5>
                </a></li>
                <li><a href="subjects.php" class="active"><i class="uil uil-edit"></i>
                    <h5>Subjects</h5>
                </a></li>
                <li><a href="attendance.php"><i class="uil uil-calendar-alt"></i>
                    <h5>Attendance</h5>
                </a></li>
                <li><a href="attendance-reports.php"><i class="uil uil-analytics"></i>
                    <h5>Attendance Reports</h5>
                </a></li>
                <?php endif ?>
            </ul>
        </aside>
        <main>
            <h2>Subjects</h2>
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
            <?php while ($subject = mysqli_fetch_assoc($subjects)) : ?>
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
            <div class="alert__message error lg section_extra-margin"><p>No subject found.</p></div>
        <?php endif ?>
      </main>
</div>
</section>

<?php
include '../partials/footer.php';
?>