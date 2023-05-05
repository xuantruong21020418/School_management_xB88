<?php
include 'partials/header.php';

//fetch sections from db
$query = "SELECT st.admission_no, st.name,
MAX( IF(sj.subject_id = 1, sc.score, NULL) ) AS 'English',
MAX( IF(sj.subject_id = 2, sc.score, NULL) ) AS 'Science'
FROM sms_score sc JOIN sms_students st ON sc.admission_no = st.admission_no
JOIN sms_subjects sj ON sc.subject_code = sj.code
GROUP BY sc.admission_no";
$scores = mysqli_query($connection, $query);
?>

<section class="dashboard">

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
                <li><a href="score.php" class="active"><i class="uil uil-edit"></i>
                    <h5>Score</h5>
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
                <?php if(isset($_SESSION['user_is_admin'])): ?>
                <li><a href="attendance-reports.php"><i class="uil uil-analytics"></i>
                    <h5>Attendance Reports</h5>
                </a></li>
                <?php endif ?>
            </ul>
        </aside>
        <main>
            <h2>Score</h2>
            <div class="utilities-container">
                <p>
                    <?php if(isset($_SESSION['user_is_admin'])): ?>
                    <button name="score-pop-up" class="btnLogin-popup"><i class="uil uil-clinic-medical"></i>Add New Score</button>
                    <?php endif ?>
                    <form class="search__bar-container" action="<?= ROOT_URL ?>admin/score-search-logic.php" method="GET">
                    <div class="search-bar">
                        <i class="uil uil-search"></i>
                        <input type="search" name="score-search" placeholder="Search Student ID">
                    </div>
                    <button type="submit" name="submit" class="btn">Go</button>
                    </form>
                </p>
            </div>

            
            <table>
                <thead>
                    <tr>
                        <th>Student Admission</th>
                        <th>Name</th>
                        <th>Subject</th>
                        <th>Score</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </main>
    </div>
</section>

<div class="wrapper">
        <span class="icon-close">
            <i class="uil uil-multiply"></i>
        </span>
        <div class="form-box login">
            <h2>Add New Score</h2>
            <?php if(isset($_SESSION['add-score'])): ?>
                <div class="alert__message error">
                    <p>
                        <?= $_SESSION['add-score'];
                        unset($_SESSION['add-score']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form action="<?= ROOT_URL ?>admin/add-score-logic.php" enctype="multipart/form-data" autocomplete="off" method="POST">
                <div class="input-box">
                    <input type="text" name="admission_no" required autocomplete="new-admission_no"
                    placeholder=" ">
                    <label>Student Admission</label>
                </div>
                <?php 
                    $subject_query = "SELECT subject FROM sms_subjects";
                    $result_subject =  mysqli_query($connection, $subject_query);

                    while ($subject = mysqli_fetch_array($result_subject, MYSQLI_ASSOC)) {
                        $subject_lower = strtolower($subject['subject']);
                        $subject_name = $subject['subject'];
                        $html = <<<HTML
                                <div class="input-box">
                                    <input type="text" name="$subject_lower" required autocomplete="new-$subject_lower"
                                    placeholder=" ">
                                    <label>$subject_name Point</label>
                                </div>
                                HTML;
                                echo $html;
                    }
                ?>
                <button type="submit" name="submit" class="btnSubmit">Save</button>
            </form>
        </div>
    </div>

<?php
include '../partials/footer.php';
?>