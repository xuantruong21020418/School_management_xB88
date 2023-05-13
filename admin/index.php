<?php
include 'partials/header.php';


//fetch subjects from db
if(isset($_SESSION['user_is_student'])) {
    $subject_query = "SELECT tc.subject, sj.thumbnail, sj.subject_id
    FROM sms_user u
    JOIN sms_students st ON u.email = st.email
    JOIN sms_teacher tc ON st.class = tc.class
    JOIN sms_subjects sj ON tc.subject = sj.subject
    WHERE u.id = $id";
    $subjects = mysqli_query($connection, $subject_query);
}
//fetch classes from db
if(isset($_SESSION['user_is_teacher'])) {
    $class_query = "SELECT cl.class_id, cl.thumbnail, tc.class
    FROM sms_user u
    JOIN sms_teacher tc ON u.email = tc.email
    JOIN sms_classes cl ON tc.class = cl.class
    WHERE u.id = $id";
    $classes = mysqli_query($connection, $class_query);
}
?>
        <?php if (isset($_SESSION['user_is_student'])) : ?>
            <section class="subject-search__bar">
                <form class="subject-search__bar-container" action="<?= ROOT_URL ?>admin/subjects-search.php" method="GET">
                    <div>
                        <i class="uil uil-search"></i>
                        <input type="search" name="subjects-search" placeholder="Search Subjects">
                    </div>
                    <button type="submit" name="submit" class="btn">Go</button>
                </form>
            </section>
            <!--------end of search-------->

            <section class="subjects">
            <div class="container subjects__container">
                <?php while ($subject = mysqli_fetch_assoc($subjects)) : ?>
                <article class="subject">
                    <div class="subject__thumbnail">
                        <a href="<?= ROOT_URL ?>admin/single-subject.php?id=<?= $subject['subject_id'] ?>">
                            <img src="../subject_thumbnails/<?= $subject['thumbnail'] ?>">
                        </a>  
                    </div>
                    <div class="subject__info">
                        <h3 class="subject__title"><?= $subject['subject'] ?></h3>
                        <p class="subject__body">Học kỳ II năm học 2022 - 2023</p>
                    </div>
                </article>
                <?php endwhile ?>
            </div>
            </section>
        <!--end of subjects-->
        <?php elseif (isset($_SESSION['user_is_teacher'])) : ?>
            <section class="subject-search__bar">
                <form class="subject-search__bar-container" action="<?= ROOT_URL ?>admin/classes-search.php" method="GET">
                    <div>
                        <i class="uil uil-search"></i>
                        <input type="search" name="classes-search" placeholder="Search">
                    </div>
                    <button type="submit" name="submit" class="btn">Go</button>
                </form>
            </section>
            <!--------end of search-------->

            <section class="subjects">
            <div class="container subjects__container">
                <?php while ($class = mysqli_fetch_assoc($classes)) : ?>
                <article class="subject">
                    <div class="subject__thumbnail">
                        <a href="<?= ROOT_URL ?>admin/single-class.php?id=<?= $class['class_id'] ?>">
                            <img src="../subject_thumbnails/<?= $class['thumbnail'] ?>">
                        </a>  
                    </div>
                    <div class="subject__info">
                        <h3 class="subject__title">Class <?= $class['class'] ?></h3>
                        <p class="subject__body">Học kỳ II năm học 2022 - 2023</p>
                    </div>
                </article>
                <?php endwhile ?>
            </div>
            </section>
        <?php endif ?>

        
<?php
include '../partials/footer.php';
?>