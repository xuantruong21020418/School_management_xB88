<?php
include 'partials/header.php';

//fetch sections from db
$query = "SELECT id, name, section, teacher FROM sms_classes
INNER JOIN sms_teacher
ON sms_classes.teacher_id = sms_teacher.teacher_id
ORDER BY id";
$classes = mysqli_query($connection, $query);
?>

<section class="dashboard">
<?php if(isset($_SESSION['add-class-success'])) : //shows if add class was successful ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['add-class-success'];
                unset($_SESSION['add-class-success']);
                ?>
            </p>
            </div>
<?php elseif(isset($_SESSION['add-class'])) : //shows if add class not was not successful ?>
        <div class="alert__message error container">
            <p>
                <?= $_SESSION['add-class'];
                unset($_SESSION['add-section']);
                ?>
            </p>
            </div>
<?php elseif(isset($_SESSION['delete-class-success'])) : //shows if delete class was successful ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['delete-class-success'];
                unset($_SESSION['delete-class-success']);
                ?>
            </p>
            </div>
<?php elseif(isset($_SESSION['delete-class'])) : //shows if delete class was not successful ?>
        <div class="alert__message error container">
            <p>
                <?= $_SESSION['delete-class'];
                unset($_SESSION['delete-class']);
                ?>
            </p>
            </div>
<?php endif ?>
    <div class="container dashboard__container">
        <button id="show__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-left-b"></i></button>
        <aside>
            <ul>
                <li><a href="classes.php" class="active"><i class="uil uil-postcard"></i></i>
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
            <h2>Classes</h2>
            <div class="container utilities-container">
            <button name="class-pop-up" class="btn pop">Add New Class</button>
            <section class="search__bar">
            <form class="container search__bar-container" action="<?= ROOT_URL ?>admin/class-search.php" method="GET">
                <div>
                    <i class="uil uil-search"></i>
                    <input type="search" name="class-search" placeholder="Search">
                </div>
                <button type="submit" name="submit" class="btn">Go</button>
            </form>
            </section>
            </div>

            <?php if(mysqli_num_rows($classes) > 0) : ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Section</th>
                        <th>Teacher</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($class = mysqli_fetch_assoc($classes)) : ?>
                    <tr>
                        <td><?= $class['id'] ?></td>
						<td><?= $class['name'] ?></td>
                        <td><?= $class['section'] ?></td>
                        <td><?= $class['teacher'] ?></td>
                        <td><a href="<?= ROOT_URL ?>admin/edit-section.php?id=<?= $class['id']?>" class="btn sm">Edit</a></td>
                        <td><a href="<?= ROOT_URL ?>admin/delete-class.php?id=<?= $class['id']?>" class="btn sm danger">Delete</a></td>
                    </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
            <?php else : ?>
                <div class="alert__message error"><?= "No classes found" ?></div>
            <?php endif ?>
        </main>
    </div>
</section>

<?php
include '../partials/footer.php';
?>