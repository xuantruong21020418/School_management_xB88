<?php
include 'partials/header.php';

//fetch sections from db
$sql = "SELECT section_id, section FROM sms_section ORDER BY section_id";
$no_of_sections = mysqli_query($connection, $sql);

//get back form data if there was an error
$section_name = $_SESSION['add-section-data']['section'] ?? null;

//delete session data
unset($_SESSION['add-section-data']);
?>

<section class="dashboard">
            <?php if(isset($_SESSION['delete-section-success'])) : //shows if delete post was successful ?>
                    <div class="alert__message success lg">
                        <p>
                            <?= $_SESSION['delete-section-success'];
                            unset($_SESSION['delete-section-success']);
                            ?>
                        </p>
                    </div>
            <?php elseif(isset($_SESSION['delete-section'])) : //shows if delete post was not successful ?>
                    <div class="alert__message error lg">
                        <p>
                            <?= $_SESSION['delete-section'];
                            unset($_SESSION['delete-section']);
                            ?>
                        </p>
                    </div>
            <?php elseif(isset($_SESSION['edit-section-success'])) : //shows if edit section was successful ?>
                    <div class="alert__message success lg">
                        <p>
                            <?= $_SESSION['edit-section-success'];
                            unset($_SESSION['edit-section-success']);
                            ?>
                        </p>
                    </div>
            <?php elseif(isset($_SESSION['edit-section'])) : //shows if edit section was not successful ?>
                    <div class="alert__message error lg">
                        <p>
                            <?= $_SESSION['edit-section'];
                            unset($_SESSION['edit-section']);
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
            </ul>
        </aside>
        <main>
            <h2>Sections</h2>
            <div class="utilities-container">
                <p>
                    <?php if(isset($_SESSION['user_is_admin'])): ?>
                    <button name="section-pop-up" class="btnLogin-popup"><i class="uil uil-clinic-medical"></i>Add New Section</button>
                    <?php endif ?>
                    <form class="search__bar-container" action="<?= ROOT_URL ?>admin/section-search-logic.php" method="GET">
                    <div class="search-bar">
                        <i class="uil uil-search"></i>
                        <input type="search" name="section-search" placeholder="Search">
                    </div>
                    <button type="submit" name="submit" class="btn">Go</button>
                    </form>
                </p>
            </div>

            <?php if(mysqli_num_rows($no_of_sections) > 0) : ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
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
                $total_pages_sql = "SELECT COUNT(*) FROM sms_section";
                $result = mysqli_query($connection, $total_pages_sql);
                $total_rows = mysqli_fetch_array($result)[0];
                $total_pages = ceil($total_rows / $no_of_records_per_page);
                $query = "SELECT section_id, section FROM sms_section ORDER BY section_id LIMIT $offset, $no_of_records_per_page";
                $sections = mysqli_query($connection, $query);
                ?>
                <?php while($section = mysqli_fetch_array($sections)) : ?>
                    <!-- //here goes the data -->
                    <tr>
                        <td><?= $section['section_id'] ?></td>
                        <td><?= $section['section'] ?></td>
                        <?php if(isset($_SESSION['user_is_admin'])): ?>
                            <td><a href="<?= ROOT_URL ?>admin/edit-section.php?id=<?= $section['section_id']?>" class="btn sm">Edit</a></td>
                            <td><a href="<?= ROOT_URL ?>admin/delete-section.php?id=<?= $section['section_id']?>" class="btn sm danger">Delete</a></td>
                        <?php endif ?>
                    </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
            <?php else : ?>
                <div class="alert__message error search"><?= "No section found." ?></div>
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
            <h2>Add New Section</h2>
            <?php if(isset($_SESSION['add-section'])): ?>
                <?php echo "<style>
                    .wrapper {
                        transform: scale(1);
                    }
                </style>";
                ?>
                <div class="alert__message error">
                    <p>
                        <?= $_SESSION['add-section'];
                            unset($_SESSION['add-section']);
                        ?>
                    </p>
                </div>
            <?php elseif(isset($_SESSION['add-section-success'])) : //shows if add post was successful ?>
                <?php echo "<style>
                    .wrapper {
                        transform: scale(1);
                    }
                </style>";
                ?>
                <div class="alert__message success">
                    <p>
                        <?= $_SESSION['add-section-success'];
                            unset($_SESSION['add-section-success']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form action="<?= ROOT_URL ?>admin/add-section-logic.php" enctype="multipart/form-data" autocomplete="off" method="POST">
                <div class="input-box">
                    <input type="text" name="section" required autocomplete="new-section"
                    value="<?= $section_name ?>" placeholder=" ">
                    <label>Section</label>
                </div>
                
                <button type="submit" name="submit" class="btnSubmit">Save</button>
                
        </div>
    </div>

<?php
include '../partials/footer.php';
?>