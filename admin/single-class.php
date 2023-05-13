<?php
require 'partials/header.php';

//fetch all subjects from subjects table
if(isset($_GET['id'])) {
$class_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
$search_class_id = $class_id;
$sql = "SELECT tp.teacher_post_id, tp.title, CONCAT_WS(' ', tc.firstname, tc.lastname) AS name, tp.created_at, u.avatar, tp.class_id
FROM sms_teacher_posts tp
JOIN sms_user u ON tp.teacher_id = u.id
JOIN sms_teacher tc ON u.email = tc.email
WHERE tp.class_id = $class_id AND tp.teacher_id = $id
ORDER BY tp.updated_at DESC, tp.created_at DESC";
$no_of_posts = mysqli_query($connection, $sql);
} else {
    header('location: ' . ROOT_URL . 'admin/index.php');
    die();
}
?>

<section class="posts">
        <?php if(isset($_SESSION['add-post'])): ?>
                <div class="alert__message error lg">
                    <p>
                        <?= $_SESSION['add-post'];
                            unset($_SESSION['add-post']);
                        ?>
                    </p>
                </div>
        <?php elseif(isset($_SESSION['add-post-success'])) : //shows if add post was successful ?>
                <div class="alert__message success lg">
                    <p>
                        <?= $_SESSION['add-post-success'];
                            unset($_SESSION['add-post-success']);
                        ?>
                    </p>
                </div>
        <?php elseif(isset($_SESSION['delete-post-success'])) : //shows if delete post was successful ?>
                    <div class="alert__message success lg">
                        <p>
                            <?= $_SESSION['delete-post-success'];
                            unset($_SESSION['delete-post-success']);
                            ?>
                        </p>
                    </div>
            <?php elseif(isset($_SESSION['delete-post'])) : //shows if delete post was not successful ?>
                    <div class="alert__message error lg">
                        <p>
                            <?= $_SESSION['delete-post'];
                            unset($_SESSION['delete-post']);
                            ?>
                        </p>
                    </div>
            <?php elseif(isset($_SESSION['edit-post-success'])) : //shows if edit post was successful ?>
                    <div class="alert__message success lg">
                        <p>
                            <?= $_SESSION['edit-post-success'];
                            unset($_SESSION['edit-post-success']);
                            ?>
                        </p>
                    </div>
            <?php elseif(isset($_SESSION['edit-post'])) : //shows if edit post was not successful ?>
                    <div class="alert__message error lg">
                        <p>
                            <?= $_SESSION['edit-post'];
                            unset($_SESSION['edit-post']);
                            ?>
                        </p>
                    </div>
            <?php endif ?>
        <section class="post-search__bar">
        <form class="post-search__bar-container" action="<?= ROOT_URL ?>admin/class-post-search-logic.php" method="GET">
            <input type="hidden" name="class_id" value="<?= $search_class_id ?>">
            <div>
                <i class="uil uil-search"></i>
                <input type="search" name="topic-search" placeholder="Search Topic">
            </div>
            <button type="submit" name="submit" class="btn">Go</button>
        </form>
        
    </section>
    <!--------end of search-------->

  <section class="dashboard__noti">
    <div class="container dashboard__noti__container">
        <main>
            <div class="header">
                <h2>Notifications</h2>
                <div class="add-noti">
                    <a href="<?= ROOT_URL ?>admin/add-post.php?id=<?= $class_id ?>" class="btn discuss">
                    <i class="uil uil-comment-alt-dots"></i> Add A New Discussion
                    </a>
                </div>
            </div>
            <?php if(mysqli_num_rows($no_of_posts) > 0) : ?>
            <table>
                <thead>
                    <tr>
                        <th>Topics</th>
                        <th>Created By</th>
                        <th>Created At</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
              <!-- pagination -->
              <?php
                if (isset($_GET['pageno'])) {
                    $pageno = $_GET['pageno'];
                } else {
                    $pageno = 1;
                }
                $no_of_records_per_page = 10;
                $offset = ($pageno-1) * $no_of_records_per_page;
                $total_pages_sql = "SELECT COUNT(*)
                FROM sms_teacher_posts tp
                WHERE tp.class_id = $class_id AND tp.teacher_id = $id";
                $result = mysqli_query($connection, $total_pages_sql);
                $total_rows = mysqli_fetch_array($result)[0];
                $total_pages = ceil($total_rows / $no_of_records_per_page);
                $query = "SELECT tp.teacher_post_id, tp.title, CONCAT_WS(' ', tc.firstname, tc.lastname) AS name, tp.created_at, u.avatar, tp.class_id
                FROM sms_teacher_posts tp
                JOIN sms_user u ON tp.teacher_id = u.id
                JOIN sms_teacher tc ON u.email = tc.email
                WHERE tp.class_id = $class_id AND tp.teacher_id = $id
                ORDER BY tp.updated_at DESC, tp.created_at DESC LIMIT $offset, $no_of_records_per_page";
                $posts = mysqli_query($connection, $query);
              ?>
                <?php while($post = mysqli_fetch_array($posts)) : ?>
                    <!-- //here goes the data -->
                    <tr>
                        <td><a href="<?= ROOT_URL ?>admin/post.php?id=<?= $post['teacher_post_id'] ?>"><?= $post['title'] ?></a></td>
						            <td>
                            <div class="user__info">
                                <div class="student-photo">
                                    <img src="<?= ROOT_URL . 'images/' . $post['avatar'] ?>">
                                </div>
                                <h3>Teacher <?= $post['name'] ?></h3>
                            </div>
                        </td>
						<td><?= $post['created_at'] ?></td>
                        <td><a href="<?= ROOT_URL ?>admin/edit-post.php?id=<?= $post['teacher_post_id']?>" class="btn sm">Edit</a></td>
                        <td><a href="<?= ROOT_URL ?>admin/delete-post.php?id=<?= $post['teacher_post_id']?>" class="btn sm danger">Delete</a></td>
                    </tr>
                    </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
            <?php else : ?>
                <div class="alert__message error lg search"><?= "No post found." ?></div>
            <?php endif ?>

            <!-- pagination -->
            <ul class="pagination">
                <li><a href="?pageno=1">First</a></li>
                <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                    <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
                </li>
                <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                    <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
                </li>
                <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
            </ul>
        </main>
    </div>
  </section>
</section>
<!-- end of single subject -->

<?php
include '../partials/footer.php';
?>