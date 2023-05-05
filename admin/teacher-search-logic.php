<?php
require 'partials/header.php';

if (isset($_GET['teacher-search']) && isset($_GET['submit'])) {
    $search = filter_var($_GET['teacher-search'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $query = "SELECT teacher_id, firstname, subject, name, section FROM sms_teacher
    INNER JOIN sms_subjects
    ON sms_teacher.subject_id = sms_subjects.subject_id
    NATURAL JOIN sms_classes
    WHERE firstname LIKE '%$search%'
    ORDER BY teacher_id";
    $teachers = mysqli_query($connection, $query);
} else {
    header('location: ' . ROOT_URL . 'admin/teachers.php');
    die();
}
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
                <li><a href="attendance-reports.php"><i class="uil uil-analytics"></i>
                    <h5>Attendance Reports</h5>
                </a></li>
                <?php endif ?>
            </ul>
        </aside>
        <main>
            <h2>Teachers</h2>
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
            <?php while ($teacher = mysqli_fetch_assoc($teachers)) : ?>
              <tr>
                <td><?= $teacher['teacher_id'] ?></td>
						    <td><?= $teacher['firstname'] ?></td>
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
            <div class="alert__message error lg section_extra-margin"><p>No teacher found.</p></div>
        <?php endif ?>
      </main>
</div>
</section>

<?php
include '../partials/footer.php';
?>