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

    <section class="dashboard__discussion">
    <div class="container dashboard__discussion__container">
        <button id="show__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-left-b"></i></button>
        <main>
            <div class="header">
                <h2>Discussions</h2>
                
                <div class="add-discussion">
                    <button type="submit" name="submit" class="btnLogin-popup"><i class="uil uil-comment-alt-dots"></i>Add A New Discussion</button>
                </div>
                
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Topics</th>
                        <th>First Started By</th>
						<th>Latest Response</th>
					    <th>Total Responses</th>
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
                                <h5>Teacher Tat-Viet Tran<br>18 Mar 2023</h5>
                            </div>
                        </td>
                        <td>
                            <div class="user__info">
                                <div class="student-photo">
                                  <img src="<?= ROOT_URL . 'css/' . "avatar1.jpg" ?>">  
                                </div>
                                <h5>Teacher Tat-Viet Tran<br>18 Mar 2023</h5>
                            </div>
                        </td>
						<td>0</td>
                    </tr>
                    <tr>
                        <td><a href="<?= ROOT_URL ?>post.php">Điểm tổng kết final</a></td>
						            <td>
                            <div class="user__info">
                                <div class="student-photo">
                                  <img src="<?= ROOT_URL . 'css/' . "avatar1.jpg" ?>">  
                                </div>
                                <h5>Teacher Tat-Viet Tran<br>18 Mar 2023</h5>
                            </div>
                        </td>
                        <td>
                            <div class="user__info">
                                <div class="student-photo">
                                  <img src="<?= ROOT_URL . 'css/' . "avatar1.jpg" ?>">  
                                </div>
                                <h5>Teacher Tat-Viet Tran<br>18 Mar 2023</h5>
                            </div>
                        </td>
						<td>0</td>
                    </tr>
                    <tr>
                        <td><a href="<?= ROOT_URL ?>post.php">Điểm tổng kết final</a></td>
						<td>
                            <div class="user__info">
                                <div class="student-photo">
                                  <img src="<?= ROOT_URL . 'css/' . "avatar1.jpg" ?>">  
                                </div>
                                <h5>Teacher Tat-Viet Tran<br>18 Mar 2023</h5>
                            </div>
                        </td>
                        <td>
                            <div class="user__info">
                                <div class="student-photo">
                                  <img src="<?= ROOT_URL . 'css/' . "avatar1.jpg" ?>">  
                                </div>
                                <h5>Teacher Tat-Viet Tran<br>18 Mar 2023</h5>
                            </div>
                        </td>
						            <td>0</td>
                    </tr>
                    <tr>
                        <td><a href="<?= ROOT_URL ?>post.php">Điểm tổng kết final</a></td>
						<td>
                            <div class="user__info">
                                <div class="student-photo">
                                  <img src="<?= ROOT_URL . 'css/' . "avatar1.jpg" ?>">  
                                </div>
                                <h5>Teacher Tat-Viet Tran<br>18 Mar 2023</h5>
                            </div>
                        </td>
                        <td>
                            <div class="user__info">
                                <div class="student-photo">
                                  <img src="<?= ROOT_URL . 'css/' . "avatar1.jpg" ?>">  
                                </div>
                                <h5>Teacher Tat-Viet Tran<br>18 Mar 2023</h5>
                            </div>
                        </td>
						<td>0</td>
                    </tr>

                </tbody>
            </table>
        </main>
    </div>
</section>

<?php
include 'partials/footer.php';
?>