<?php
include 'partials/header.php';


//fetch subjects from db
$query = "SELECT * FROM sms_admin_posts ap ORDER BY ap.updated_at DESC, ap.created_at DESC";
$no_of_posts = mysqli_query($connection, $query);
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
        <form class="post-search__bar-container" action="<?= ROOT_URL ?>admin/general-post-search-logic.php" method="GET">
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
                <?php if(isset($_SESSION['user_is_admin'])): ?>
                <div class="add-noti">
                    <a href="<?= ROOT_URL ?>admin/add-general-post.php" class="btn discuss">
                    <i class="uil uil-comment-alt-dots"></i> Add A New Discussion
                    </a>
                </div>
                <?php endif ?>
            </div>
            <?php if(mysqli_num_rows($no_of_posts) > 0) : ?>
            <table>
                <thead>
                    <tr>
                        <th>Topics</th>
                        <th>Created By</th>
                        <th>Created At</th>
                        <?php if(isset($_SESSION['user_is_admin'])): ?>
                          <th>Edit</th>
                          <th>Delete</th>
                        <?php endif ?>
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
                $total_pages_sql = "SELECT COUNT(*) FROM sms_admin_posts";
                $result = mysqli_query($connection, $total_pages_sql);
                $total_rows = mysqli_fetch_array($result)[0];
                $total_pages = ceil($total_rows / $no_of_records_per_page);
                $query = "SELECT * FROM sms_admin_posts ap
                ORDER BY ap.updated_at DESC, ap.created_at DESC LIMIT $offset, $no_of_records_per_page";
                $posts = mysqli_query($connection, $query);
              ?>
                <?php while($post = mysqli_fetch_array($posts)) : ?>
                    <!-- //here goes the data -->
                    <tr>
                        <td><a href="<?= ROOT_URL ?>admin/general-post.php?id=<?= $post['admin_post_id'] ?>"><?= $post['title'] ?></a></td>
						            <td>The School Admin.</td>
						            <td><?= $post['created_at'] ?></td>
                        <?php if(isset($_SESSION['user_is_admin'])): ?>
                          <td><a href="<?= ROOT_URL ?>admin/edit-general-post.php?id=<?= $post['admin_post_id']?>" class="btn sm">Edit</a></td>
                          <td><a href="<?= ROOT_URL ?>admin/delete-general-post.php?id=<?= $post['admin_post_id']?>" class="btn sm danger">Delete</a></td>
                        <?php endif ?>
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
        
<?php
include '../partials/footer.php';
?>