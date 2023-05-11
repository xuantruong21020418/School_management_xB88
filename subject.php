<?php
include 'partials/header.php';

//fetch subject from db if id is set
if(isset($_GET['id'])) {
    $subject_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM sms_subjects WHERE subject_id = $subject_id";
    $result = mysqli_query($connection, $query);
    $subject = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'index.php');
    die();
}
?>
        
        <section class="singlesubject">
            <div class="container singlesubject__container">
                <h2>General</h2>
                <!--notifications-->
                    <div class="subject__section">
                        <a class="subject__section-icon" href="subject-noti.php">
                            <i class="uil uil-comment-alt-message"></i>
                        </a>
                        <a class="subject__section-info" href="subject-noti.php">
                            <h5>DIỄN ĐÀN</h5>
                            <h5>Thông báo</h5>     
                        </a>
                    </div>
                <!-- <div class="singlesubject__thumbnail">
                    <img src="./images/<?= $subject['thumbnail'] ?>">
                </div>
                <p>
                    <?= $subject['body'] ?>
                </p> -->
            </div>
        </section>

<!-- end of single subject -->

<?php
include 'partials/footer.php';
?>