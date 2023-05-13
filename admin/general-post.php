<?php
include 'partials/header.php';

//fetch post from db if id is set
if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT *
    FROM sms_admin_posts ap
    WHERE ap.admin_post_id = $id";
    $result = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'admin/general-notis.php');
    die();
}
?>
        
        <section class="singlepost">
            <div class="container singlepost__container">
                <h2><?= $post['title'] ?></h2>
                <div class="post__author"> 
                    <div class="post__author-info">
                        <h5>By: The School Admin</h5>
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