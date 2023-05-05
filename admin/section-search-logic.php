<?php
require 'partials/header.php';

if (isset($_GET['section-search']) && isset($_GET['submit'])) {
    $search = filter_var($_GET['section-search'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $query = "SELECT section_id, section FROM sms_section
    WHERE section LIKE '%$search%' ORDER BY section_id";
    $sections = mysqli_query($connection, $query);
} else {
    header('location: ' . ROOT_URL . 'admin/sections.php');
    die();
}
?>

<section class="dashboard">
<?php if(isset($_SESSION['add-section-success'])) : //shows if add section was successful ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['add-section-success'];
                unset($_SESSION['add-section-success']);
                ?>
            </p>
            </div>
<?php elseif(isset($_SESSION['edit-section-success'])) : //shows if edit section was successful ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['edit-section-success'];
                unset($_SESSION['edit-section-success']);
                ?>
            </p>
            </div>
<?php elseif(isset($_SESSION['edit-section'])) : //shows if edit section was not successful ?>
        <div class="alert__message error container">
            <p>
                <?= $_SESSION['edit-section'];
                unset($_SESSION['edit-section']);
                ?>
            </p>
            </div>
<?php elseif(isset($_SESSION['delete-section-success'])) : //shows if delete section was successful ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['delete-section-success'];
                unset($_SESSION['delete-section-success']);
                ?>
            </p>
            </div>
<?php elseif(isset($_SESSION['delete-section'])) : //shows if delete section was not successful ?>
        <div class="alert__message error container">
            <p>
                <?= $_SESSION['delete-section'];
                unset($_SESSION['delete-section']);
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
                <li><a href="sections.php" class="active"><i class="uil uil-building"></i>
                    <h5>Sections</h5>
                </a></li>
                <li><a href="scores.php"><i class="uil uil-edit"></i>
                    <h5>Scores</h5>
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
                <li><a href="attendance-reports.php"><i class="uil uil-analytics"></i>
                    <h5>Attendance Reports</h5>
                </a></li>
                <?php endif ?>
            </ul>
      </aside>
    <main>
        <h2>Sections</h2>
        <?php if(mysqli_num_rows($sections) > 0) : ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Section</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
          <tbody>
            <?php while ($section = mysqli_fetch_assoc($sections)) : ?>
              <tr>
                    <td><?= $section['section_id'] ?></td>
                    <td><?= $section['section'] ?></td>
                    <td><a href="<?= ROOT_URL ?>admin/edit-section.php?id=<?= $section['section_id']?>" class="btn sm">Edit</a></td>
                    <td><a href="<?= ROOT_URL ?>admin/delete-section.php?id=<?= $section['section_id']?>" class="btn sm danger">Delete</a></td>
              </tr>
            <?php endwhile ?>
          </tbody>
        </table>
        <?php else : ?>
            <div class="alert__message error lg section_extra-margin"><p>No section found.</p></div>
        <?php endif ?>
      </main>
</div>
</section>

<?php
include '../partials/footer.php';
?>