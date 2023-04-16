<?php
include 'partials/header.php';

if(isset($_GET['id'])) {
    $subject_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM sms_subjects WHERE subject_id = $subject_id";
    $result = mysqli_query($connection, $query);
    $subject = mysqli_fetch_assoc($result);
} else {
    header('location: '. ROOT_URL . 'admin/subjects.php');
    die();
}
?>

          <div class="form-box edit">
            <h2>Edit Subject</h2>
            <?php if(isset($_SESSION['edit-subject'])): ?>
                <div class="alert__message error">
                    <p>
                        <?= $_SESSION['edit-subject'];
                        unset($_SESSION['edit-subject']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form action="<?= ROOT_URL ?>admin/edit-subject-logic.php" enctype="multipart/form-data" autocomplete="off" method="POST">
            <input type="hidden" name="subject_id" value="<?= $subject['subject_id'] ?>">
                <div class="input-box">
                    <input type="text" name="subject" required autocomplete="new-subject"
                    value="<?= $subject['subject'] ?>" placeholder=" ">
                    <label>Subject</label>
                </div>
                <label>Type</label>
                <select name="type">
                    <option value="Theoretical">Theoretical</option>
                    <option value="Practical">Practical</option>
                </select>

                <div class="input-box">
                    <input type="text" name="code" required autocomplete="new-code"
                    value="<?= $subject['code'] ?>" placeholder=" ">
                    <label>Subject Code</label>
                </div>
                
                <button type="submit" name="submit" class="btnSubmit">Save</button>
                
        </div>

<?php
include '../partials/footer.php';
?>