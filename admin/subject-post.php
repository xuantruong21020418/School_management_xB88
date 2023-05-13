<?php
include 'partials/header.php';

//fetch post from db if id is set
if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT tp.teacher_post_id, tp.title, CONCAT_WS(' ', tc.firstname, tc.lastname) AS name, tp.body, tp.created_at, u.avatar
    FROM sms_teacher_posts tp
    JOIN sms_user u ON tp.teacher_id = u.id
    JOIN sms_teacher tc ON u.email = tc.email
    WHERE tp.teacher_post_id = $id";
    $result = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'admin/single-subject.php');
    die();
}
?>
        
        <section class="singlepost">
            <div class="container singlepost__container">
                <h2><?= $post['title'] ?></h2>
                <div class="post__author"> 
                    <div class="student-photo">
                        <img src="<?= ROOT_URL . 'images/' . $post['avatar'] ?>">
                    </div>
                    <div class="post__author-info">
                        <h5>By: <?= $post['name'] ?></h5>
                        <small><?= $post['created_at'] ?></small>
                    </div>
                </div>

                <p>
                    <?php echo $post['body'] ?>
                </p>  
            </div>
        </section>
<!-- end of single post -->

<?php
include '../partials/footer.php';
?>