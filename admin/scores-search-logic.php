<?php
require 'partials/header.php';

$search_form = -1;

if (isset($_SESSION['user_is_student'])) {
    if (isset($_GET['scores-search-mssv']) && isset($_GET['submit'])) {
        $mssv_search = filter_var($_GET['scores-search-mssv'], FILTER_SANITIZE_NUMBER_INT);
        if ($mssv_search == NULL) {
            header('location: ' . ROOT_URL . 'admin/scores.php');
            die();
            $search_form = -1;
        } else {
            $query = "SELECT st.admission_no, st.name, sj.subject, sc.score
            FROM sms_scores sc JOIN sms_students st ON sc.admission_no = st.admission_no
            JOIN sms_subjects sj ON sc.subject_code = sj.code
            WHERE st.admission_no = $mssv_search";
            $mssv_scores = mysqli_query($connection, $query);
            $mssv_scores_subject = mysqli_query($connection, $query);
            $mssv_scores_name = mysqli_query($connection, $query);
            $search_form = 0;
        }
    }
}
if (isset($_SESSION['user_is_teacher'])) {
    if (isset($_GET['scores-search-mssv']) && isset($_GET['submit'])) {
        $mssv_search = filter_var($_GET['scores-search-mssv'], FILTER_SANITIZE_NUMBER_INT);
        if ($mssv_search == NULL) {
            header('location: ' . ROOT_URL . 'admin/scores.php');
            die();
            $search_form = -1;
        } else {
            $query = "SELECT st.admission_no, st.name, st.class, sj.subject, sc.score, st.email
            FROM sms_user u
            JOIN sms_teacher tc ON u.email = tc.email
            JOIN sms_subjects sj ON tc.subject = sj.subject
            JOIN sms_scores sc ON sj.code = sc.subject_code
            JOIN sms_students st ON sc.admission_no = st.admission_no
            WHERE u.id = $id AND st.admission_no = $mssv_search";
            $mssv_scores = mysqli_query($connection, $query);
            $mssv_scores_subject = mysqli_query($connection, $query);
            $mssv_scores_name = mysqli_query($connection, $query);
            $search_form = 0;
        }
    } elseif (isset($_GET['scores-search-class']) && isset($_GET['submit'])) {
        $class_search = filter_var($_GET['scores-search-class'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ($class_search == NULL) {
            header('location: ' . ROOT_URL . 'admin/scores.php');
            die();
            $search_form = -1;
        } else {
            $query = "SELECT st.admission_no, st.name, st.class, sc.score, sc.subject_code
            FROM sms_scores sc JOIN sms_students st ON sc.admission_no = st.admission_no
            JOIN sms_subjects sj ON sc.subject_code = sj.code
            WHERE st.class LIKE '$class_search'";
            $class_scores = mysqli_query($connection, $query);
            $search_form = 1;
        }
    }
}

if (isset($_SESSION['user_is_admin'])) {
    if (isset($_GET['scores-search-mssv']) && isset($_GET['submit'])) {
        $mssv_search = filter_var($_GET['scores-search-mssv'], FILTER_SANITIZE_NUMBER_INT);
        if ($mssv_search == NULL) {
            header('location: ' . ROOT_URL . 'admin/scores.php');
            die();
            $search_form = -1;
        } else {
            $query = "SELECT st.admission_no, st.name, sj.subject, sc.score
            FROM sms_scores sc
            JOIN sms_subjects sj ON sc.subject_code = sj.code
            JOIN sms_students st ON sc.admission_no = st.admission_no
            WHERE st.admission_no = $mssv_search";
            $mssv_scores = mysqli_query($connection, $query);
            $mssv_scores_subject = mysqli_query($connection, $query);
            $mssv_scores_name = mysqli_query($connection, $query);
            $search_form = 0;
        }
    } elseif (isset($_GET['scores-search-class']) && isset($_GET['submit'])) {
        $class_search = filter_var($_GET['scores-search-class'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ($class_search == NULL) {
            header('location: ' . ROOT_URL . 'admin/scores.php');
            die();
            $search_form = -1;
        } else {
            $query = "SELECT st.admission_no, st.name, st.class, sc.score, sc.subject_code
            FROM sms_scores sc JOIN sms_students st ON sc.admission_no = st.admission_no
            JOIN sms_subjects sj ON sc.subject_code = sj.code
            WHERE st.class LIKE '$class_search'";
            $class_scores = mysqli_query($connection, $query);
            $search_form = 1;
        }
    }
}
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
    <?php if (isset($_SESSION['user_is_student'])) : ?>
        <?php if($search_form == 0) : ?>
        <h2>Scores - MSSV: <?= $mssv_search ?></h2>
        <div class="utilities-container">
                <p>
                    <div class="search_section">
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
        <?php if(mysqli_num_rows($mssv_scores) > 0) : ?>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <?php while($mssv_score_subject = mysqli_fetch_assoc($mssv_scores_subject)) : ?>
                            <th><?= $mssv_score_subject['subject'] ?></th>
                        <?php endwhile ?>   
                    </tr>
                </thead>
                <tbody>
                    
                    <tr>
                        <?php  
                            $mssv_score_name = mysqli_fetch_assoc($mssv_scores_name);
                        ?>
						<td><?= $mssv_score_name['name'] ?></td>
                        <?php while($mssv_score = mysqli_fetch_assoc($mssv_scores)) : ?>
                            <td><?= $mssv_score['score'] ?></td>                       
                        <?php endwhile ?> 
                    </tr>
                    
                </tbody>
            </table>
            <?php else : ?>
                <div class="alert__message error search"><?= "No score found." ?></div>
            <?php endif ?>
        <?php endif ?>

    <?php elseif (isset($_SESSION['user_is_teacher'])) : ?>
        <?php if($search_form == 0) : ?>
        <h2>Scores - MSSV: <?= $mssv_search ?></h2>
        <div class="utilities-container">
                <p>
                    <div class="search_section">
                        <form class="search__bar-container" action="<?= ROOT_URL ?>admin/scores-search-logic.php" method="GET">
                        <div class="search-bar">
                            <i class="uil uil-search"></i>
                            <input type="search" name="scores-search-class" placeholder="Search Class">
                        </div>   
                        <button type="submit" name="submit" class="btn">Go</button>                   
                        </form>
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
        <?php if(mysqli_num_rows($mssv_scores) > 0) : ?>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <?php while($mssv_score_subject = mysqli_fetch_assoc($mssv_scores_subject)) : ?>
                            <th><?= $mssv_score_subject['subject'] ?></th>
                        <?php endwhile ?>   
                    </tr>
                </thead>
                <tbody>
                    
                    <tr>
                        <?php  
                            $mssv_score_name = mysqli_fetch_assoc($mssv_scores_name);
                        ?>
						<td><?= $mssv_score_name['name'] ?></td>
                        <?php while($mssv_score = mysqli_fetch_assoc($mssv_scores)) : ?>
                            <td><?= $mssv_score['score'] ?></td>                       
                        <?php endwhile ?> 
                    </tr>
                    
                </tbody>
            </table>
            <?php else : ?>
                <div class="alert__message error search"><?= "No score found." ?></div>
            <?php endif ?>
        <?php elseif($search_form == 1) : ?>
        <h2>Scores - Class: <?= $class_search ?></h2>
        <div class="utilities-container">
                <p>
                    <?php if(isset($_SESSION['user_is_teacher'])): ?>
                    <a href="<?= ROOT_URL ?>admin/add-scores.php" class="btn">
                    <i class="uil uil-clinic-medical"></i>Add New Scores</a>
                    <?php endif ?>
                    <div class="search_section">
                        <form class="search__bar-container" action="<?= ROOT_URL ?>admin/scores-search-logic.php" method="GET">
                        <div class="search-bar">
                            <i class="uil uil-search"></i>
                            <input type="search" name="scores-search-class" placeholder="Search Class">
                        </div>   
                        <button type="submit" name="submit" class="btn">Go</button>                   
                        </form>   
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
        <?php if(mysqli_num_rows($class_scores) > 0) : ?>
            <table>
                <thead>
                    <tr>
                        <th>MSSV</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Score</th>  
                    </tr>
                </thead>
                <tbody>
                    <?php while($class_score = mysqli_fetch_assoc($class_scores)) : ?>
                    <tr>
                        <td><?= $class_score['admission_no'] ?></td>
						<td><?= $class_score['name'] ?></td>
                        <td><?= $class_score['class'] ?></td>
                        <td><?= $class_score['score'] ?></td>
                    </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
            <?php else : ?>
                <div class="alert__message error search"><?= "No score found." ?></div>
            <?php endif ?>
        <?php endif ?>
        <!-- adminsearch -->
        <?php elseif (isset($_SESSION['user_is_admin'])) : ?>
        <?php if($search_form == 0) : ?>
        <h2>Scores - MSSV: <?= $mssv_search ?></h2>
        <div class="utilities-container">
                <p>
                    <div class="search_section">
                        <form class="search__bar-container" action="<?= ROOT_URL ?>admin/scores-search-logic.php" method="GET">
                        <div class="search-bar">
                            <i class="uil uil-search"></i>
                            <input type="search" name="scores-search-class" placeholder="Search Class">
                        </div>   
                        <button type="submit" name="submit" class="btn">Go</button>                   
                        </form>
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
        <?php if(mysqli_num_rows($mssv_scores) > 0) : ?>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <?php while($mssv_score_subject = mysqli_fetch_assoc($mssv_scores_subject)) : ?>
                            <th><?= $mssv_score_subject['subject'] ?></th>
                        <?php endwhile ?>   
                    </tr>
                </thead>
                <tbody>
                    
                    <tr>
                        <?php  
                            $mssv_score_name = mysqli_fetch_assoc($mssv_scores_name);
                        ?>
						<td><?= $mssv_score_name['name'] ?></td>
                        <?php while($mssv_score = mysqli_fetch_assoc($mssv_scores)) : ?>
                            <td><?= $mssv_score['score'] ?></td>                       
                        <?php endwhile ?> 
                    </tr>
                    
                </tbody>
            </table>
            <?php else : ?>
                <div class="alert__message error search"><?= "No score found." ?></div>
            <?php endif ?>
        <?php elseif($search_form == 1) : ?>
        <h2>Scores - Class: <?= $class_search ?></h2>
        <div class="utilities-container">
                <p>
                    <?php if(isset($_SESSION['user_is_teacher'])): ?>
                    <a href="<?= ROOT_URL ?>admin/add-scores.php" class="btn">
                    <i class="uil uil-clinic-medical"></i>Add New Scores</a>
                    <?php endif ?>
                    <div class="search_section">
                        <form class="search__bar-container" action="<?= ROOT_URL ?>admin/scores-search-logic.php" method="GET">
                        <div class="search-bar">
                            <i class="uil uil-search"></i>
                            <input type="search" name="scores-search-class" placeholder="Search Class">
                        </div>   
                        <button type="submit" name="submit" class="btn">Go</button>                   
                        </form>   
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
        <?php if(mysqli_num_rows($class_scores) > 0) : ?>
            <table>
                <thead>
                    <tr>
                        <th>MSSV</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Score</th>  
                    </tr>
                </thead>
                <tbody>
                    <?php while($class_score = mysqli_fetch_assoc($class_scores)) : ?>
                    <tr>
                        <td><?= $class_score['admission_no'] ?></td>
						<td><?= $class_score['name'] ?></td>
                        <td><?= $class_score['class'] ?></td>
                        <td><?= $class_score['score'] ?></td>
                    </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
            <?php else : ?>
                <div class="alert__message error search"><?= "No score found." ?></div>
            <?php endif ?>
        <?php endif ?>
        <!-- endofadminsearch -->
    <?php endif ?>
    </main>
</div>
</section>

<?php
include '../partials/footer.php';
?>
