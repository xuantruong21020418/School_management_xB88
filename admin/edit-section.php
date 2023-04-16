<?php
include 'partials/header.php';

if(isset($_GET['id'])) {
    $section_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM sms_section WHERE section_id = $section_id";
    $result = mysqli_query($connection, $query);
    $section = mysqli_fetch_assoc($result);
} else {
    header('location: '. ROOT_URL . 'admin/sections.php');
    die();
}
?>

          <div class="form-box edit">
            <h2>Edit Section</h2>
            <?php if(isset($_SESSION['edit-section'])): ?>
                <div class="alert__message error">
                    <p>
                        <?= $_SESSION['edit-section'];
                        unset($_SESSION['edit-section']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form action="<?= ROOT_URL ?>admin/edit-section-logic.php" enctype="multipart/form-data" autocomplete="off" method="POST">
            <input type="hidden" name="section_id" value="<?= $section['section_id'] ?>">
                <div class="input-box">
                    <input type="text" name="section" required autocomplete="new-section"
                    value='<?= $section['section'] ?>' placeholder=" ">
                    <label>Section</label>
                </div>
                
                <button type="submit" name="submit" class="btnSubmit">Save</button>
                
        </div>

<?php
include '../partials/footer.php';
?>