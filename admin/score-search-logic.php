<?php
require 'partials/header.php';

if (isset($_GET['score-search']) && isset($_GET['submit'])) {
    $search = filter_var($_GET['score-search'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $query = "SELECT st.admission_no, st.name, sj.subject, sc.score
    FROM sms_score sc JOIN sms_students st ON sc.admission_no = st.admission_no
    JOIN sms_subjects sj ON sc.subject_code = sj.code
    WHERE st.admission_no = $search";
    $scores = mysqli_query($connection, $query);
} else {
    header('location: ' . ROOT_URL . 'admin/students.php');
    die();
}
?>


<section class="dashboard">

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
                <li><a href="attendance-reports.php"><i class="uil uil-analytics"></i>
                    <h5>Attendance Reports</h5>
                </a></li>
                <?php endif ?>
            </ul>
      </aside>
    <main>
        <h2>Score</h2>
        <?php if(mysqli_num_rows($scores) > 0) : ?>
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
                    <?php while($score = mysqli_fetch_assoc($scores)) : ?>
                    <tr>
						<td><?= $score['admission_no'] ?></td>
						<td><?= $score['name'] ?></td>
						<td><?= $score['subject'] ?></td>
                        <td><?= $score['score'] ?></td>
                    </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
            <?php else : ?>
                <div class="alert__message error"><?= "No score found." ?></div>
            <?php endif ?>
      </main>
</div>
</section>

<?php
include '../partials/footer.php';
?>
