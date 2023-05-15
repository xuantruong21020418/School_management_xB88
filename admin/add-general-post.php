<?php
include 'partials/header.php';

//get back form data if there was an error
$title = $_SESSION['add-post-data']['title'] ?? null;

//delete session data
unset($_SESSION['add-post-data']);
?>

    <div class="form-box-post">
            <h2>Add A New Discussion</h2>
            <?php if(isset($_SESSION['add-post'])): ?>
                <div class="alert__message error">
                    <p>
                        <?= $_SESSION['add-post'];
                        unset($_SESSION['add-post']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
        <form action="<?= ROOT_URL ?>admin/add-general-post-logic.php" enctype="multipart/form-data" autocomplete="off" method="POST" onsubmit="getContent()">  
             <!-- toolbar -->
                    <div class="response-container" id="response-container">
                    <div class="input-box">
                        <input type="text" name="title" required autocomplete="new-title" id="title"
                        placeholder="" value="<?= $title ?>">
                        <label>Title</label>
                    </div>
                    <h3>Body</h3>
                        <div class="toolbar">
                            <div class="fileContainer">
                                <label for="fileInput">
                                    <i class="uil uil-cloud-upload"></i>
                                </label>
                                <input type="file" id="fileInput" name="photo">
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
                        <div id="text" contenteditable="true"></div>
                        <input type="hidden" id="body" name="body">
                        <!-- <input type="hidden" id="photo" name="photo"> -->
                        <input type="hidden" name="class_id" value="<?= $class_id ?>">
                        <button type="submit" name="submit" class="btnSubmit">Save</button>
                        
                    </div>
            <!-- endOfToolBar -->
        </form>
    </div>
<?php
include '../partials/footer.php';
?>