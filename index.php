<?php
include 'partials/header.php';

//fetch all subjects from subjects table
$query = "SELECT * FROM sms_subjects ORDER BY subject_id";
$subjects = mysqli_query($connection, $query);
?>
        <section class="subject-search__bar">
            <form class="subject-search__bar-container" action="<?= ROOT_URL ?>search.php" method="GET">
                <div>
                    <i class="uil uil-search"></i>
                    <input type="search" name="search" placeholder="Search Subject">
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
                        <a href="subject.php?id=<?= $subject['subject_id'] ?>">
                            <img src="./subject_thumbnails/<?= $subject['thumbnail'] ?>">
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

<?php
include 'partials/footer.php';
?>