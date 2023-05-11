<?php
include 'partials/header.php';
?>

        <div class="form-box">
            <h2>Add New Scores</h2>
            <?php if(isset($_SESSION['add-scores'])): ?>
                <div class="alert__message error">
                    <p>
                        <?= $_SESSION['add-scores'];
                        unset($_SESSION['add-scores']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form action="<?= ROOT_URL ?>admin/add-score-logic.php" enctype="multipart/form-data" autocomplete="off" method="POST">
                <!-- <div id="tab1" class="tabcontent">
                  <h3>Tab 1</h3>
                  <p>Content for Tab 1.</p>
                </div>

                <div id="tab2" class="tabcontent">
                  <h3>Tab 2</h3>
                  <p>Content for Tab 2.</p>
                </div>

                <div id="tab3" class="tabcontent">
                  <h3>Tab 3</h3>
                  <p>Content for Tab 3.</p>
                </div> -->
                <label>Subjects</label>
                <select name="subjects" id="tabSelect" onchange="openTab(event)">
                    <?php  
                        $all_subjects_query = "SELECT subject FROM sms_scores sc 
                        JOIN sms_subjects sj ON sc.subject_code = sj.code";
                        $all_subjects = mysqli_query($connection, $all_subjects_query);
                    ?>
                    <?php while($subject = mysqli_fetch_assoc($all_subjects)) : ?>
                        <option value="<?= $subject['subject'] ?>"><?= $subject['subject'] ?></option>
                    <?php endwhile ?>
                </select>
                <?php  
                    $subjects_query = "SELECT subject, name, score FROM sms_scores sc 
                    JOIN sms_subjects sj ON sc.subject_code = sj.code
                    JOIN sms_students st ON sc.admission_no = st.admission_no
                    ";
                    $subjects = mysqli_query($connection, $subjects_query);
                ?>
                <?php while($subject = mysqli_fetch_assoc($subjects)) : ?>
                  <div class="input-box" id="<?= $score['subject'] ?>">
                    <input type="text" name="student_score" required autocomplete="new-student_score"
                    value=<?= $subject['score'] ?> placeholder=" ">
                    <label><?= $subject['name'] ?></label>
                  </div>
                <?php endwhile ?>
                
                
                <button type="submit" name="submit" class="btnSubmit">Save</button>
            </form>
        </div>

<?php
include '../partials/footer.php';
?>