<?php
include 'partials/header.php';

//fetch classes from db
$sql = "SELECT class_id, class, section
FROM sms_classes
ORDER BY class_id";
$no_of_classes = mysqli_query($connection, $sql);

//get back form data if there was an error
$class_name = $_SESSION['add-class-data']['class'] ?? null;
$section_name = $_SESSION['add-class-data']['section'] ?? null;

//delete class data
unset($_SESSION['add-class-data']);
?>

<section class="dashboard">
<?php if(isset($_SESSION['delete-class-success'])) : //shows if delete class was successful ?>
        <div class="alert__message success lg">
            <p>
                <?= $_SESSION['delete-class-success'];
                unset($_SESSION['delete-class-success']);
                ?>
            </p>
            </div>
<?php elseif(isset($_SESSION['delete-class'])) : //shows if delete class was not successful ?>
        <div class="alert__message error lg">
            <p>
                <?= $_SESSION['delete-class'];
                unset($_SESSION['delete-class']);
                ?>
            </p>
            </div>
<?php elseif(isset($_SESSION['edit-class-success'])) : //shows if edit class was successful ?>
        <div class="alert__message success lg">
            <p>
                <?= $_SESSION['edit-class-success'];
                unset($_SESSION['edit-class-success']);
                ?>
            </p>
            </div>
<?php elseif(isset($_SESSION['edit-class'])) : //shows if edit class was not successful ?>
        <div class="alert__message error lg">
            <p>
                <?= $_SESSION['edit-class'];
                unset($_SESSION['edit-class']);
                ?>
            </p>
            </div>
<?php endif ?>
    <div class="container dashboard__container">
        <button id="show__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-left-b"></i></button>
        <aside>
            <ul>
				<li><a href="classes.php" class="active"><i class="uil uil-presentation-edit"></i>
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
                <li><a href="subjects.php"><i class="uil uil-edit"></i>
                    <h5>Subjects</h5>
                </a></li>
                <?php if(isset($_SESSION['user_is_teacher'])): ?>
                <li><a href="index.php"><i class="uil uil-edit"></i>
                    <h5>Mangage Classes</h5>
                </a></li>
                <?php elseif(isset($_SESSION['user_is_student'])): ?>
                <li><a href="index.php"><i class="uil uil-edit"></i>
                    <h5>Mangage Subjects</h5>
                </a></li>
                <?php endif ?>
                <li><a href="general-notis.php"><i class="uil uil-edit"></i>
                    <h5>General Notifications</h5>
                </a></li> 
            </ul>
        </aside>
        <main>
            <h2>Classes</h2>
            <div class="utilities-container">
                <p>
                    <?php if(isset($_SESSION['user_is_admin'])): ?>
                    <button type="submit" name="submit" class="btnLogin-popup"><i class="uil uil-presentation-plus"></i>Add New Class</button>
                    <?php endif ?>
                    <form class="search__bar-container" action="<?= ROOT_URL ?>admin/class-search-logic.php" method="GET">
                    <div class="search-bar">
                        <i class="uil uil-search"></i>
                        <input type="search" name="class-search" placeholder="Search">
                    </div>
                    <button type="submit" name="submit" class="btn">Go</button>
                    </form>
                </p>
            </div>

            <?php if(mysqli_num_rows($no_of_classes) > 0) : ?>
            <table>
                <thead>
                    <tr>
                        <th>Class</th>
                        <th>Section</th>
                        <?php if(isset($_SESSION['user_is_admin'])): ?>
                        <th>Edit</th>
                        <th>Delete</th>
                        <?php endif ?>
                    </tr>
                </thead>
                <tbody>
                    <!-- pagination -->
                <?php
                if (isset($_GET['pageno'])) {
                    $pageno = $_GET['pageno'];
                } else {
                    $pageno = 1;
                }
                $no_of_records_per_page = 10;
                $offset = ($pageno-1) * $no_of_records_per_page;
                $total_pages_sql = "SELECT COUNT(*) FROM sms_classes";
                $result = mysqli_query($connection, $total_pages_sql);
                $total_rows = mysqli_fetch_array($result)[0];
                $total_pages = ceil($total_rows / $no_of_records_per_page);
                $query = "SELECT class_id, class, section FROM sms_classes
                ORDER BY class_id LIMIT $offset, $no_of_records_per_page";
                $classes = mysqli_query($connection, $query);
                ?>
                <?php while($class = mysqli_fetch_array($classes)) : ?>
                    <!-- //here goes the data -->
                    <tr>
						<td><?= $class['class'] ?></td>
                        <td><?= $class['section'] ?></td>
                        <?php if(isset($_SESSION['user_is_admin'])): ?>
                        <td><a href="<?= ROOT_URL ?>admin/edit-class.php?id=<?= $class['class_id']?>" class="btn sm">Edit</a></td>
                        <td><a href="<?= ROOT_URL ?>admin/delete-class.php?id=<?= $class['class_id']?>" class="btn sm danger">Delete</a></td>
                        <?php endif ?>
                    </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
            <?php else : ?>
                <div class="alert__message error search"><?= "No class found." ?></div>
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
            <h2>Add New Class</h2>
<?php if(isset($_SESSION['add-class-success'])) : //shows if add class was successful ?>
    <?php echo "<style>
                    .wrapper {
                        transform: scale(1);
                    }
                </style>";
                ?>
        <div class="alert__message success">
            <p>
                <?= $_SESSION['add-class-success'];
                unset($_SESSION['add-class-success']);
                ?>
            </p>
            </div>
<?php elseif(isset($_SESSION['add-class'])) : //shows if add class was not successful ?>
    <?php echo "<style>
                    .wrapper {
                        transform: scale(1);
                    }
                </style>";
                ?>
        <div class="alert__message error">
            <p>
                <?= $_SESSION['add-class'];
                unset($_SESSION['add-class']);
                ?>
            </p>
            </div>
<?php endif ?>
            <form action="<?= ROOT_URL ?>admin/add-class-logic.php" enctype="multipart/form-data" autocomplete="off" method="POST">
                <div class="input-box">
                    <input type="text" name="class" required autocomplete="new-class"
                    value="<?= $class ?>" placeholder=" ">
                    <label>Class</label>
                </div>
            
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
                <button type="submit" name="submit" class="btnSubmit">Save</button>
            </form>
        </div>
    </div>

<?php
include '../partials/footer.php';
?>