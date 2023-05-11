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
                <input type="search" name="search" placeholder="Search Topic">
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
                    <button type="submit" name="submit" class="btnLogin-popup"><i class="uil uil-comment-alt-dots"></i>Add A New Discussion</button>
                </div>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Topics</th>
                        <th>Created By</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><a href="<?= ROOT_URL ?>post.php">Điểm tổng kết final</a></td>
						<td>
                            <div class="user__info">
                                <div class="student-photo">
                                  <img src="<?= ROOT_URL . 'css/' . "avatar1.jpg" ?>">  
                                </div>
                                <h3>Teacher Tat-Viet Tran</h3>
                            </div>
                        </td>
						<td>18 Mar 2023</td>
                    </tr>
                    <tr>
                        <td><a href="<?= ROOT_URL ?>post.php">Điểm tổng kết final</a></td>
						<td>
                            <div class="user__info">
                                <div class="student-photo">
                                  <img src="<?= ROOT_URL . 'css/' . "avatar1.jpg" ?>">  
                                </div>
                                <h3>Teacher Tat-Viet Tran</h3>
                            </div>
                        </td>
						<td>18 Mar 2023</td>
                    </tr>
                    <tr>
                        <td><a href="<?= ROOT_URL ?>post.php">Điểm tổng kết final</a></td>
						<td>
                            <div class="user__info">
                                <div class="student-photo">
                                  <img src="<?= ROOT_URL . 'css/' . "avatar1.jpg" ?>">  
                                </div>
                                <h3>Teacher Tat-Viet Tran</h3>
                            </div>
                        </td>
						<td>18 Mar 2023</td>
                    </tr>

                </tbody>
            </table>
        </main>
    </div>
</section>
<!-- end of single subject -->

<?php
include 'partials/footer.php';
?>