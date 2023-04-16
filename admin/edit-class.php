<?php
include 'partials/header.php';

if(isset($_GET['id'])) {
    $class_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT class_id, class, section FROM sms_classes
    NATURAL JOIN sms_section
    WHERE class_id=$class_id";
    $result = mysqli_query($connection, $query);
    $class = mysqli_fetch_assoc($result);
} else {
    header('location: '. ROOT_URL . 'admin/classs.php');
    die();
}
?>

          <div class="form-box edit">
            <h2>Edit Class</h2>
            <?php if(isset($_SESSION['edit-class'])): ?>
                <div class="alert__message error">
                    <p>
                        <?= $_SESSION['edit-class'];
                        unset($_SESSION['edit-class']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form action="<?= ROOT_URL ?>admin/edit-class-logic.php" enctype="multipart/form-data" autocomplete="off" method="POST">
                <input type="hidden" name="class_id" value="<?= $class['class_id'] ?>">
                <div class="input-box">
                    <input type="text" name="class" required autocomplete="new-class"
                    value='<?= $class['class'] ?>' placeholder=" ">
                    <label>Class</label>
                </div>
                <label>Section</label>
                <select name="section">
                    <?php  
                        $all_sections_query = "SELECT * FROM sms_section";
                        $all_sections = mysqli_query($connection, $all_sections_query);
                    ?>
                    <?php while($section = mysqli_fetch_assoc($all_sections)) : ?>
                        <option value="<?= $section['section'] ?>"><?= $section['section'] ?></option>
                    <?php endwhile ?>
                </select>
                
                <button type="submit" name="submit" class="btnSubmit">Save</button>
                
        </div>

<?php
include '../partials/footer.php';
?>