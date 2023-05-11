<?php
require 'partials/header.php';

if (isset($_GET['subject-search']) && isset($_GET['submit'])) {
    $search = filter_var($_GET['subject-search'], FILTER_SANITIZE_NUMBER_INT);
    if ($search == NULL) {
        header('location: ' . ROOT_URL . 'admin/subjects.php');
        die();
    } else {
        $sql = "SELECT * FROM sms_subjects
        WHERE code = $search";
        $no_of_subjects = mysqli_query($connection, $sql);
    }
} else {
    header('location: ' . ROOT_URL . 'admin/subjects.php');
    die();
}
//get back form data if there was an error
$subject_name = $_SESSION['add-subject-data']['subject'] ?? null;
$type = $_SESSION['add-subject-data']['type'] ?? null;
$code = $_SESSION['add-subject-data']['code'] ?? null;

//delete session data
unset($_SESSION['add-subject-data']);
?>

<section class="dashboard">
<?php if(isset($_SESSION['edit-subject-success'])) : //shows if edit subject was successful ?>
        <div class="alert__message success lg">
            <p>
                <?= $_SESSION['edit-subject-success'];
                unset($_SESSION['edit-subject-success']);
                ?>
            </p>
            </div>
<?php elseif(isset($_SESSION['edit-subject'])) : //shows if edit subject was not successful ?>
        <div class="alert__message error lg">
            <p>
                <?= $_SESSION['edit-subject'];
                unset($_SESSION['edit-subject']);
                ?>
            </p>
            </div>
<?php elseif(isset($_SESSION['delete-subject-success'])) : //shows if delete subject was successful ?>
        <div class="alert__message success lg">
            <p>
                <?= $_SESSION['delete-subject-success'];
                unset($_SESSION['delete-subject-success']);
                ?>
            </p>
            </div>
<?php elseif(isset($_SESSION['delete-subject'])) : //shows if delete subject was not successful ?>
        <div class="alert__message error lg">
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
            <div class="utilities-container">
                <p>
                    <?php if(isset($_SESSION['user_is_admin'])): ?>
                    <button name="subject-pop-up" class="btnLogin-popup"><i class="uil uil-create-dashboard"></i>Add New Subject</button>
                    <?php endif ?>
                    <form class="search__bar-container" action="<?= ROOT_URL ?>admin/subject-search-logic.php" method="GET">
                    <div class="search-bar">
                        <i class="uil uil-search"></i>
                        <input type="search" name="subject-search" placeholder="Search">
                    </div>
                    <button type="submit" name="submit" class="btn">Go</button>
                    </form>
                </p>
            </div>
            <?php if(mysqli_num_rows($no_of_subjects) > 0) : ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
						<th>Subject</th>
						<th>Code</th>
                        <th>Subject Type</th>
                        <?php if(isset($_SESSION['user_is_admin'])): ?>
						<th>Edit</th>
                        <th>Delete</th>
                        <?php endif ?>
                    </tr>
                </thead>
                <tbody>
                <?php
                if (isset($_GET['pageno'])) {
                    $pageno = $_GET['pageno'];
                } else {
                    $pageno = 1;
                }
                $no_of_records_per_page = 10;
                $offset = ($pageno-1) * $no_of_records_per_page;
                $total_pages_sql = "SELECT COUNT(*) FROM sms_subjects";
                $result = mysqli_query($connection, $total_pages_sql);
                $total_rows = mysqli_fetch_array($result)[0];
                $total_pages = ceil($total_rows / $no_of_records_per_page);
                $query = "SELECT * FROM sms_subjects
                WHERE code = $search LIMIT $offset, $no_of_records_per_page";
                $subjects = mysqli_query($connection, $query);
                ?>
                <?php while($subject = mysqli_fetch_array($subjects)) : ?>
                    <!-- //here goes the data -->
                    <tr>
                        <td><?= $subject['subject_id'] ?></td>
						<td><?= $subject['subject'] ?></td>
                        <td><?= $subject['code'] ?></td>
                        <td><?= $subject['type'] ?></td>
                        <?php if(isset($_SESSION['user_is_admin'])): ?>
                        <td><a href="<?= ROOT_URL ?>admin/edit-subject.php?id=<?= $subject['subject_id']?>" class="btn sm">Edit</a></td>
                        <td><a href="<?= ROOT_URL ?>admin/delete-subject.php?id=<?= $subject['subject_id']?>" class="btn sm danger">Delete</a></td>
                        <?php endif ?>
                    </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
            <?php else : ?>
                <div class="alert__message error search"><?= "No subject found." ?></div>
            <?php endif ?>

            <!-- pagination -->
            <ul class="pagination">
                <li><a href="?pageno=1">First</a></li>
                <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                    <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
                </li>
                <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                    <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
                </li>
                <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
            </ul>
      </main>
</div>
</section>

<div class="wrapper">
        <span class="icon-close">
            <i class="uil uil-multiply"></i>
        </span>
        <div class="form-box">
            <h2>Add New Subject</h2>
        <?php if(isset($_SESSION['add-subject-success'])) : //shows if add subject was successful ?>
            <?php echo "<style>
                    .wrapper {
                        transform: scale(1);
                    }
                </style>";
                ?>
                <div class="alert__message success">
                    <p>
                        <?= $_SESSION['add-subject-success'];
                        unset($_SESSION['add-subject-success']);
                        ?>
                    </p>
                </div>
        <?php elseif(isset($_SESSION['add-subject'])): //shows if add subject was not successful ?>
            <?php echo "<style>
                    .wrapper {
                        transform: scale(1);
                    }
                </style>";
                ?>
                <div class="alert__message error">
                    <p>
                        <?= $_SESSION['add-subject'];
                        unset($_SESSION['add-subject']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form action="<?= ROOT_URL ?>admin/add-subject-logic.php" enctype="multipart/form-data" autocomplete="off" method="POST">
                <div class="input-box">
                    <input type="text" name="subject" required autocomplete="new-subject"
                    value="<?= $subject_name ?>" placeholder=" ">
                    <label>Subject</label>
                </div>
                <label>Type</label>
                <select name="type">
                    <option value="Theoretical">Theoretical</option>
                    <option value="Practical">Practical</option>
                </select>

                <div class="input-box">
                    <input type="text" name="code" required autocomplete="new-code"
                    value="<?= $code ?>" placeholder=" ">
                    <label>Subject Code</label>
                </div>
                <button type="submit" name="submit" class="btnSubmit">Save</button>
                
        </div>
    </div>

<?php
include '../partials/footer.php';
?>