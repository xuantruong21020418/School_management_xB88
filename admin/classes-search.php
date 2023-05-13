<?php
include 'partials/header.php';

    if (isset($_GET['classes-search']) && isset($_GET['submit'])) {
        $classes_search = filter_var($_GET['classes-search'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ($classes_search == NULL) {
            header('location: ' . ROOT_URL . 'admin/index.php');
            die();
        } else {
            $class_query = "SELECT cl.class_id, cl.thumbnail, tc.class
            FROM sms_user u
            JOIN sms_teacher tc ON u.email = tc.email
            JOIN sms_classes cl ON tc.class = cl.class
            WHERE u.id = $id AND tc.class LIKE '$classes_search'";
            $classes = mysqli_query($connection, $class_query);
        }
    }
?>
            <section class="subject-search__bar">
                <form class="subject-search__bar-container" action="<?= ROOT_URL ?>admin/classes-search.php" method="GET">
                    <div>
                        <i class="uil uil-search"></i>
                        <input type="search" name="classes-search" placeholder="Search Classes">
                    </div>
                    <button type="submit" name="submit" class="btn">Go</button>
                </form>
            </section>
            <!--------end of search-------->
            <?php if(mysqli_num_rows($classes) <= 0) : ?>
              <div class="alert__message error bg"><?= "No class found." ?></div>
            <?php else : ?>
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