<?php
include 'partials/header.php';

//fetch scores from db
if(isset($_SESSION['user_is_student'])) {
    $query = "SELECT u.email, st.admission_no, st.name, sj.subject, sc.score
    FROM sms_user u
    JOIN sms_students st ON u.email = st.email
    JOIN sms_scores sc ON st.admission_no = sc.admission_no
    JOIN sms_subjects sj ON sc.subject_code = sj.code
    WHERE u.id = $id";
    $scores = mysqli_query($connection, $query);
    $scores_subject = mysqli_query($connection, $query);
    $scores_info = mysqli_query($connection, $query);
}
if(isset($_SESSION['user_is_teacher'])) {
    $sql = "SELECT st.admission_no, st.name, st.class, sc.score, st.email
    FROM sms_user u
    JOIN sms_teacher tc ON u.email = tc.email
    JOIN sms_subjects sj ON tc.subject = sj.subject
    JOIN sms_scores sc ON sj.code = sc.subject_code
    JOIN sms_students st ON sc.admission_no = st.admission_no
    WHERE u.id = $id";
    $query = "SELECT sj.code FROM sms_teacher tc
    JOIN sms_user u ON tc.email = u.email
    JOIN sms_subjects sj ON tc.subject = sj.subject
    WHERE u.id = $id";
    $result = mysqli_query($connection, $query);
    $subject = mysqli_fetch_assoc($result);
    $sj_code = $subject['code'];
    $no_of_class_scores = mysqli_query($connection, $sql);
}
?>

<section class="dashboard">
<?php if(isset($_SESSION['add-score-success'])): //shows if add score was successful ?>
    <div class="alert__message success lg">
        <p>
            <?= $_SESSION['add-score-success'];
            unset($_SESSION['add-score-success']);
            ?>
        </p>
    </div>
<?php elseif(isset($_SESSION['add-score'])): //shows if add score was not successful ?>
    <div class="alert__message error lg">
        <p>
            <?= $_SESSION['add-score'];
            unset($_SESSION['add-score']);
            ?>
        </p>
    </div>
<?php elseif(isset($_SESSION['edit-score-success'])) : //shows if edit score was successful ?>
        <div class="alert__message success lg">
            <p>
                <?= $_SESSION['edit-score-success'];
                unset($_SESSION['edit-score-success']);
                ?>
            </p>
            </div>
<?php elseif(isset($_SESSION['edit-score'])) : //shows if edit score was not successful ?>
        <div class="alert__message error lg">
            <p>
                <?= $_SESSION['edit-score'];
                unset($_SESSION['edit-score']);
                ?>
            </p>
            </div>
<?php elseif(isset($_SESSION['delete-score-success'])) : //shows if delete score was successful ?>
        <div class="alert__message success lg">
            <p>
                <?= $_SESSION['delete-score-success'];
                unset($_SESSION['delete-score-success']);
                ?>
            </p>
            </div>
<?php elseif(isset($_SESSION['delete-score'])) : //shows if delete score was not successful ?>
        <div class="alert__message error lg">
            <p>
                <?= $_SESSION['delete-score'];
                unset($_SESSION['delete-score']);
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
                <li><a href="sections.php"><i class="uil uil-building"></i>
                    <h5>Sections</h5>    
                </a></li>
                <li><a href="scores.php" class="active"><i class="uil uil-edit"></i>
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
            </ul>
        </aside>
        <main>
            <h2>Scores</h2>

                <?php if(isset($_SESSION['add-score-success'])) : //shows if add score was successful ?>
                <div class="alert__message success">
                    <p>
                        <?= $_SESSION['add-score-success'];
                        unset($_SESSION['add-score-success']);
                        ?>
                    </p>
                </div>
                <?php elseif(isset($_SESSION['add-score'])) : //shows if add score was not successful ?>
                <div class="alert__message error">
                    <p>
                        <?= $_SESSION['add-score'];
                        unset($_SESSION['add-score']);
                        ?>
                    </p>
                </div>
                <?php endif ?>
            <?php if(isset($_SESSION['user_is_student'])): ?>
            <?php $score_info = mysqli_fetch_assoc($scores_info) ?>
            <h3>MSSV: <?= $score_info['admission_no'] ?> - Name: <?= $score_info['name'] ?></h3>
            <?php endif ?>
            <div class="utilities-container">
                <p>
                    <?php if(isset($_SESSION['user_is_teacher'])): ?>
                    <a href="<?= ROOT_URL ?>admin/add-scores.php?code=<?= $sj_code ?>" class="btn score">
                    <i class="uil uil-clinic-medical"></i>Add New Scores</a>
                    <?php endif ?>
                    <div class="search_section">
                        <?php if(isset($_SESSION['user_is_teacher'])): ?>
                        <form class="search__bar-container" action="<?= ROOT_URL ?>admin/scores-search-logic.php" method="GET">
                        <div class="search-bar">
                            <i class="uil uil-search"></i>
                            <input type="search" name="scores-search-class" placeholder="Search Class">
                        </div>   
                        <button type="submit" name="submit" class="btn">Go</button>                   
                        </form>
                        <?php endif ?>
                        <form class="search__bar-container" action="<?= ROOT_URL ?>admin/scores-search-logic.php" method="GET">
                        <div class="search-bar">
                            <i class="uil uil-search"></i>
                            <input type="search" name="scores-search-mssv" placeholder="Search Student ID">
                        </div>
                        <button type="submit" name="submit" class="btn">Go</button>  
                        </form>
                    </div>                 
                </p>
            </div>
            
            <!-- tobeedited -->
            
            <!-- tobeedited -->

            <?php if(isset($_SESSION['user_is_student'])): ?>
                <?php if(mysqli_num_rows($scores) > 0) : ?>
                    <table>
                        <thead>
                            <tr>
                                <?php while($score_subject = mysqli_fetch_assoc($scores_subject)) : ?>
                                    <th><?= $score_subject['subject'] ?></th>
                                <?php endwhile ?>
                            </tr>
                        </thead>
                        <tbody>
                            
                        
                            <tr>
                                <?php while($score = mysqli_fetch_assoc($scores)) : ?>
                                    <td><?= $score['score'] ?></td>                       
                                <?php endwhile ?> 
                            </tr>
                            
                        </tbody>
                    </table>
                <?php else : ?>
                    <div class="alert__message error search"><?= "No score found." ?></div>
                <?php endif ?>
            <?php elseif(isset($_SESSION['user_is_teacher'])) : ?>
                <?php if(mysqli_num_rows($no_of_class_scores) > 0) : ?>
                <table>
                <thead>
                    <tr>
                        <th>MSHS</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Score</th>
                        <th>Edit</th>
                        <th>Delete</th>
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
                $total_pages_sql = 
                "SELECT COUNT(st.admission_no)
                FROM sms_user u
                JOIN sms_teacher tc ON u.email = tc.email
                JOIN sms_subjects sj ON tc.subject = sj.subject
                JOIN sms_scores sc ON sj.code = sc.subject_code
                JOIN sms_students st ON sc.admission_no = st.admission_no
                WHERE u.id = $id
                ORDER BY st.name";
                $result = mysqli_query($connection, $total_pages_sql);
                $total_rows = mysqli_fetch_array($result)[0];
                $total_pages = ceil($total_rows / $no_of_records_per_page);
                $query = 
                "SELECT st.admission_no, st.name, st.class, sc.score, st.email
                FROM sms_user u
                JOIN sms_teacher tc ON u.email = tc.email
                JOIN sms_subjects sj ON tc.subject = sj.subject
                JOIN sms_scores sc ON sj.code = sc.subject_code
                JOIN sms_students st ON sc.admission_no = st.admission_no
                WHERE u.id = $id
                ORDER BY st.name
                LIMIT $offset, $no_of_records_per_page";
                $class_scores = mysqli_query($connection, $query);
                ?>
                <?php while($class_score = mysqli_fetch_assoc($class_scores)) : ?>
                    <!-- //here goes the data -->
                    <tr>
                        <td><?= $class_score['admission_no'] ?></td>
                        <td><?= $class_score['name'] ?></td>
                        <td><?= $class_score['class'] ?></td>
                        <td><?= $class_score['score'] ?></td>
                        <td><a href="<?= ROOT_URL ?>admin/edit-scores.php?admission_no=<?= $class_score['admission_no']?>" class="btn sm">Edit</a></td>
                        <td><a href="<?= ROOT_URL ?>admin/delete-student.php?admission_no=<?= $class_score['admission_no']?>" class="btn sm danger">Delete</a></td>
                    </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
            <?php else : ?>
                <div class="alert__message error search"><?= "No student found." ?></div>
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
            <?php endif ?>

        </main>
    </div>
</section>

<?php
include '../partials/footer.php';
?>