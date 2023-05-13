<?php
include 'partials/header.php';

if (isset($_GET['code'])) {
$code = filter_var($_GET['code'], FILTER_SANITIZE_NUMBER_INT);
}
//get back form data if there was an error
$score = $_SESSION['add-score-data']['score'] ?? null;

//delete session data
unset($_SESSION['add-score-data']);
?>
        <div class="form-box">
            <h2>Add New Scores</h2>
            <?php if(isset($_SESSION['add-score'])): ?>
                <div class="alert__message error lg">
                    <p>
                        <?= $_SESSION['add-score'];
                        unset($_SESSION['add-score']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form action="<?= ROOT_URL ?>admin/add-scores-logic.php" enctype="multipart/form-data" autocomplete="off" method="POST">
                
                <?php  
                    $students_query = "SELECT sc.ID, sc.name FROM sms_scores sc 
                    WHERE sc.subject_code = $code;
                    ";
                    $students = mysqli_query($connection, $students_query);
                ?>
                <?php while($student = mysqli_fetch_assoc($students)) : ?>
                  <div class="input-box">
                    <input type="text" required autocomplete="new-scores"
                    name="scores[<?php echo $student['ID']; ?>]" placeholder=" ">
                    <label><?= $student['name'] ?></label>
                  </div>
                <?php endwhile ?>
                <button type="submit" name="submit" class="btnSubmit">Save</button>
            </form>
        </div>

<?php
include '../partials/footer.php';
?>