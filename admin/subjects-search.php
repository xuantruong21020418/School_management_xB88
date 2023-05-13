<?php
include 'partials/header.php';

    if (isset($_GET['subjects-search']) && isset($_GET['submit'])) {
        $subjects_search = filter_var($_GET['subjects-search'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ($subjects_search == NULL) {
            header('location: ' . ROOT_URL . 'admin/index.php');
            die();
        } else {
            $subject_query = "SELECT tc.subject, sj.thumbnail, sj.subject_id
            FROM sms_user u
            JOIN sms_students st ON u.email = st.email
            JOIN sms_teacher tc ON st.class = tc.class
            JOIN sms_subjects sj ON tc.subject = sj.subject
            WHERE u.id = $id AND tc.subject LIKE '$subjects_search'";
            $subjects = mysqli_query($connection, $subject_query);
        }
    }
?>
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

          <?php if(mysqli_num_rows($subjects) <= 0) : ?>
            <div class="alert__message error bg"><?= "No subject found." ?></div>
          <?php else : ?>
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
          <?php endif ?>
        <!--end of subjects-->

        
<?php
include '../partials/footer.php';
?>