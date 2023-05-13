<?php
include 'partials/header.php';

if(isset($_GET['id'])) {
  $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
  $query = "SELECT *
  FROM sms_admin_posts ap
  WHERE admin_post_id = $id";
  $result = mysqli_query($connection, $query);
  $post = mysqli_fetch_assoc($result);
} else {
  header('location: ' . ROOT_URL . 'admin/general-notis.php');
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
        <form action="<?= ROOT_URL ?>admin/edit-general-post-logic.php" enctype="multipart/form-data" autocomplete="off" method="POST" onsubmit="getContent()">  
             <!-- toolbar -->
                    <div class="response-container" id="response-container">
                    <input type="hidden" name="post_id" value="<?= $post['admin_post_id'] ?>">
                    <div class="input-box">
                        <input type="text" name="title" required autocomplete="new-title" id="title"
                        placeholder=" " value="<?= $post['title'] ?>">
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
                            <label for="font-size">Font Size:</label>
                            <select id="font-size">
                                <option value="1">Small</option>
                                <option value="3" selected>Normal</option>
                                <option value="5">Large</option>
                                <option value="7">Extra Large</option>
                            </select>
                            <label for="font-family">Font Family:</label>
                            <select id="font-family">
                                <option value="Montserrat" selected>Montserrat</option>
                                <option value="Arial">Arial</option>
                                <option value="Courier New">Courier New</option>
                                <option value="Times New Roman">Times New Roman</option>
                                <option value="Verdana">Verdana</option>
                            </select>

                            <button type="button" class="icon-button" onclick="alignText('left')">
                                <i class="uil uil-align-left"></i>
                            </button>
                            <button type="button" class="icon-button" onclick="alignText('center')">
                                <i class="uil uil-align-center"></i>
                            </button>
                            <button type="button" class="icon-button" onclick="alignText('right')">
                                <i class="uil uil-align-right"></i>
                            </button>
                            <button type="button" class="icon-button" id="bold-button">
                                <i class="uil uil-bold"></i>
                            </button>
                            <button type="button" class="icon-button" onclick="formatText('italic')">
                                <i class="uil uil-italic"></i>
                            </button>
                        </div>
                        <div id="text" contenteditable="true"><?= $post['body'] ?></div>
                        <input type="hidden" id="body" name="body">
                        <button type="submit" name="submit" class="btnSubmit">Save</button>
                        
                    </div>
            <!-- endOfToolBar -->
        </form>
    </div>
<?php
include '../partials/footer.php';
?>