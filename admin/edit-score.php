<?php
include 'partials/header.php';

if(isset($_GET['admission_no'])) {
    $admission_no = filter_var($_GET['admission_no'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM sms_scores
    WHERE admission_no = $admission_no";
    $result = mysqli_query($connection, $query);
    $student = mysqli_fetch_assoc($result);
} else {
    header('location: '. ROOT_URL . 'admin/scores.php');
    die();
}
?>

        <div class="form-box edit">
            <h2>Edit Student</h2>
            <?php if(isset($_SESSION['edit-score'])): ?>
                <div class="alert__message error">
                    <p>
                        <?= $_SESSION['edit-score'];
                        unset($_SESSION['edit-score']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form action="<?= ROOT_URL ?>admin/edit-score-logic.php" enctype="multipart/form-data" autocomplete="off" method="POST">
                <div class="input-box">
                    <input type="text" name="admission_no" required autocomplete="new-admission_no"
                    value='<?= $student['admission_no'] ?>' placeholder=" ">
                    <label>MSSV</label>
                </div>
                <div class="input-box">
                    <input type="text" name="fullname" required autocomplete="new-fullname"
                    value='<?= $student['name'] ?>' placeholder=" ">
                    <label>Full Name</label>
                </div>
                <div class="input-box">
                    <input type="text" name="score" required autocomplete="new-score"
                    value=<?= $student['score'] ?> placeholder=" ">
                    <label>Score</label>
                </div>
                
                <button type="submit" name="submit" class="btnSubmit">Save</button>
            </form>
        </div>

<?php
include '../partials/footer.php';
?>