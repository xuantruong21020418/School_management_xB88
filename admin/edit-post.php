<?php
include 'partials/header.php';

if(isset($_GET['id'])) {
  $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
  $query = "SELECT tp.teacher_post_id, tp.title, CONCAT_WS(' ', tc.firstname, tc.lastname) AS name, tp.body
  FROM sms_teacher_posts tp
  JOIN sms_user u ON tp.teacher_id = u.id
  JOIN sms_teacher tc ON u.email = tc.email
  WHERE tp.teacher_post_id = $id";
  $result = mysqli_query($connection, $query);
  $class = mysqli_fetch_assoc($result);
} else {
  header('location: ' . ROOT_URL . 'admin/single-class.php');
  die();
}
?>

    <div class="form-box-post">
            <h2>Edit Post</h2>
            <?php if(isset($_SESSION['edit-post'])): ?>
                <div class="alert__message error">
                    <p>
                        <?= $_SESSION['edit-post'];
                        unset($_SESSION['edit-post']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
        <form action="<?= ROOT_URL ?>admin/edit-post-logic.php" enctype="multipart/form-data" autocomplete="off" method="POST" onsubmit="getContent()">  
             <!-- toolbar -->
                    <div class="response-container" id="response-container">
                    <input type="hidden" name="post_id" value="<?= $class['teacher_post_id'] ?>">
                    <div class="input-box">
                        <input type="text" name="title" required autocomplete="new-title" id="title"
                        placeholder=" " value="<?= $class['title'] ?>">
                        <label>Title</label>
                    </div>
                    <h3>Body</h3>
                        <div class="toolbar">
                            <div class="fileContainer">
                                <label for="fileInput">
                                    <i class="uil uil-cloud-upload"></i>
                                </label>
                                <input type="file" id="fileInput" onchange="getFilename()" name="photo">
                                <span id="fileName"></span>
                            </div>
                            <label for="fontSize">Font Size:</label>
                            <select id="fontSize">
                                <option value="10">10</option>
                                <option value="12">12</option>
                                <option value="14">14</option>
                                <option value="16" selected>16</option>
                                <option value="18">18</option>
                                <option value="20">20</option>
                            </select>

                            <label for="fontFamily">Font:</label>
                                <select id="fontFamily">
                                <option value="'Montserrat', sans-serif" selected>Montserrat</option>
                                <option value="Arial">Arial</option>
                                <option value="Courier New">Courier New</option>
                                <option value="Georgia">Georgia</option>
                                <option value="Times New Roman">Times New Roman</option>
                                <option value="Verdana">Verdana</option>
                            </select>

                            <button class="icon-button" onclick="alignText('left')">
                                <i class="uil uil-align-left"></i>
                            </button>
                            <button class="icon-button" onclick="alignText('center')">
                                <i class="uil uil-align-center"></i>
                            </button>
                            <button class="icon-button" onclick="alignText('right')">
                                <i class="uil uil-align-right"></i>
                            </button>
                            <button class="icon-button" onclick="formatText('bold')">
                                <i class="uil uil-bold"></i>
                            </button>
                            <button class="icon-button" onclick="formatText('italic')">
                                <i class="uil uil-italic"></i>
                            </button>
                        </div>
                        <div id="text" contenteditable="true"><?= $class['body'] ?></div>
                        <input type="hidden" id="body" name="body">
                        <button type="submit" name="submit" class="btnSubmit">Save</button>
                        
                    </div>
            <!-- endOfToolBar -->
        </form>
    </div>
<?php
include '../partials/footer.php';
?>