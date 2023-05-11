<?php
require 'config/constants.php';

$email = $_SESSION['signin-data']['email'] ?? null;
$password = $_SESSION['signin-data']['password'] ?? null;

unset($_SESSION['signin-data']);
?>
<!DOCTYPE html>
<html lang=""en>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>School Management Systems</title>
        <link rel="stylesheet" href="<?= ROOT_URL ?>/css/signin.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    </head>
    <body>
        <!-- NAVIGATION CREATION -->
    <header>
    <h2 class="logo">SMS</h2>
    <nav class="navigation">
          <a href="<?= ROOT_URL ?>index.php">Home</a>
          <a href="<?= ROOT_URL ?>about.php">About</a>
          <a href="<?= ROOT_URL ?>services.php">Services</a>
          <a href="<?= ROOT_URL ?>contact.php">Contact</a>
          <button type="submit" name="submit" class="btnLogin-popup">Sign In</button>

    </nav>
    </header>

    <div class="item">
            <div class="text-item">
                <h2>The incredibly easy, incredibly engaging Q&A platform<br><span>
                Save time and help students learn using the power of community 
                </span></h2>
            </div>
            <div class="tutor-container">
                <p>
                    <div class="vid">
                        <a href="https://piazza.com/">
                            <img src="Untitled.png">
                        </a>
                    </div>
                    <ul style="line-height:180%" class="advantages">
                        <li>Wiki style format enables collaboration in a single space</li>
                        <li>Features LaTeX editor, highlighted syntax and code blocking</li>
                        <li>Questions and posts needing immediate action are highlighted</li>
                        <li>Instructors endorse answers to keep the class on track</li>
                        <li>Anonymous posting encourages every student to participate</li>
                        <li>Highly customizable online polls</li>
                        <li>Integrates with every major LMS</li>
                    </ul>
                </p>
            </div>

            <div class="getstarted-container">
                <a href="<?= ROOT_URL ?>" class="student-started">Students Get Started</a>
                <a href="<?= ROOT_URL ?>" class="prof-started">Professors and TAs Get Started</a>
                <a href="<?= ROOT_URL ?>" class="class-started">View A Real Class</a>
            </div>

            <p class="learnmore">
                <a class="learnmore-link" href="https://piazza.com/legal/ferpa">Learn more</a> about how Piazza complies with FERPA
            </p>

            <div class="new_to-container">
                <p>New to SMS? Watch these videos to get started:</p>
                <div class="started_vids-container">
                    <a href="https://www.youtube.com/" class="started-link">Creating and Configuring Your Class</a>
                    <a href="https://www.youtube.com/" class="started-link">Posting your first note</a>
                    <a href="https://www.youtube.com/" class="started-link">Piazza intro for students</a>
                    <a href="https://www.youtube.com/" class="started-link">Announcing Piazza to students</a>
                    <a href="https://www.youtube.com/" class="started-link">Organizational tips with folders</a>
                </div>
                <p>Our team is on standby to help you get started with Piazza. 
                    Email us at <a class="help-link" href="https://www.google.com/intl/vi/gmail/about/">team@piazza.com</a> if you need help!
                </p>
            </div>

            <section class="feedback">
                <div class="text-item">
                    <h2>Over 100,000 professors have chosen Piazza.
                        Millions of students in thousands of universities in 90 countries are using Piazza.<br><span>
                        Click on an instructor to see why
                    </span></h2>
                </div>

                <div class="instructors-container">
                    <a class="instructor" href="https://piazza.com/professors#jennifer_schwartz">
                        <img class="instructor-avatar" src="./css/avatar1.jpg">
                        <div class="instructor-info">
                            <p class="instructor-name">Tran Tat Viet</p>
                            <p class="instructor-subject">Information Technology</p>
                        </div>
                        <div class="quote">"Kịch bản ấy đẹp, tiếc là đã không thể xảy ra được."</div>
                    </a>
                    <a class="instructor" href="https://piazza.com/professors#ron_lee">
                        <img class="instructor-avatar" src="./css/avatar2.jpg">
                        <div class="instructor-info">
                            <p class="instructor-name">Tran Xuan Truong</p>
                            <p class="instructor-subject">Information Technology</p>
                        </div>
                        <div class="quote">"Trước khi khẳng định người ta sai, hay tự hỏi xem mình đã đúng chưa đã."</div>
                    </a>
                    <a class="instructor" href="https://piazza.com/professors#slobodan_simic">
                        <img class="instructor-avatar" src="./css/avatar3.jpg">
                        <div class="instructor-info">
                            <p class="instructor-name">Duong Khanh Toan</p>
                            <p class="instructor-subject">Information Technology</p>
                        </div>
                        <div class="quote">"Anh biết, nhưng thế là quá ít."</div>
                    </a>
                    <a class="instructor" href="https://piazza.com/professors#paul_hegarty">
                        <img class="instructor-avatar" src="./css/avatar4.jpg">
                        <div class="instructor-info">
                            <p class="instructor-name">Nguyen Tien Phong</p>
                            <p class="instructor-subject">Information Technology</p>
                        </div>
                        <div class="quote">"Đúng, nhưng chưa đủ em ạ."</div>
                    </a>
                    
                </div>
            </section>


        <div class="categories">
            <div class="text-item">
                <h2>Learn how Piazza works for your subject<br><span>
                    Click subject to view
                </span></h2>
            </div>
            <div class="categories-container">
                <a href="#"><i class="uil uil-desktop"></i>Computer Science</a>
                <a href="#"><i class="uil uil-cog"></i>Engineering</a>
                <a href="#"><i class="uil uil-calculator"></i>Mathematics</a>
                <a href="#"><i class="uil uil-atom"></i>Physics</a>
                <a href="#"><i class="uil uil-balance-scale"></i>Economics</a>
                <a href="#"><i class="uil uil-flask"></i>Chemistry</a>
                <a href="#"><i class="uil uil-bed"></i>Psychology</a>
                <a href="#"><i class="uil uil-dna"></i>Biology</a>
            </div>
        </div>

        <div class="story-container">
            <div class="text-item">
                <h2>Our story</h2>
            </div>
            <div class="storyvid-container">
                <p>
                <div class="story-vid">
                    <a href="https://piazza.com/">
                        <img src="Untitled2.png">
                    </a>
                </div>
                <div class="story-content">
                    <p> 
                    Piazza is designed to connect students, TAs, and professors so every student can get the help they need when they need it.<br>
                    Today, millions of students across thousands of campuses are using Piazza for their classes.
                    It warms me to think I started something that is impacting the way students learn and the way instructors teach.<br>
                    I sincerely hope Piazza enhances your experience as a student, as a TA, and as a professor.<br>
                    — Pooja Nath Sankar, Piazza Founder
                    </p>
                </div>
                    
                </p>
            </div>
            
        </div>

        <footer>
            <div class="footer__socials">
                <a href="https://youtube.com" target="_blank"><i class="uil uil-youtube"></i></a>
                <a href="https://facebook.com" target="_blank"><i class="uil uil-facebook-f"></i></a>
                <a href="https://instagram.com" target="_blank"><i class="uil uil-instagram"></i></a>
                <a href="https://linkedIn.com" target="_blank"><i class="uil uil-linkedin"></i></a>
                <a href="https://twitter.com" target="_blank"><i class="uil uil-twitter"></i></a>
            </div>
            <div class="footer__container">
                <article>
                    <h4>Categories</h4>
                    <ul>
                        <li><a href="">Art</a></li>
                        <li><a href="">Wild Life</a></li>
                        <li><a href="">Travel</a></li>
                        <li><a href="">Food</a></li>
                        <li><a href="">Music</a></li>
                    </ul>
                </article>
                <article>
                    <h4>Support</h4>
                    <ul>
                        <li><a href="">Online Support</a></li>
                        <li><a href="">Call Numbers</a></li>
                        <li><a href="">Emails</a></li>
                        <li><a href="">Social Support</a></li>
                        <li><a href="">Location</a></li>
                    </ul>
                </article>
                <article>
                    <h4>Blog</h4>
                    <ul>
                        <li><a href="">Safety</a></li>
                        <li><a href="">Repair</a></li>
                        <li><a href="">Recent</a></li>
                        <li><a href="">Popular</a></li>
                        <li><a href="">Categories</a></li>
                    </ul>
                </article>
                <article>
                    <h4>Permalinks</h4>
                    <ul>
                        <li><a href="">Home</a></li>
                        <li><a href="">About</a></li>
                        <li><a href="">Services</a></li>
                        <li><a href="">Contact</a></li>
                    </ul>
                </article>
            </div>
            <div class="footer__copyright">
                <small>Copyright &copy; 2023</small>
            </div>
        </footer>
    </div>

    <div class="wrapper">
        <span class="icon-close">
            <ion-icon name="close"></ion-icon>
        </span>
        <div class="form-box login">
            <h2>Sign In</h2>
            <?php if(isset($_SESSION['signin'])): ?>
                <?php echo "<style>
                .wrapper {
                    transform: scale(1);
                }
                </style>";
                ?>
                <div class="alert__message error">
                    <p>
                        <?= $_SESSION['signin'];
                        unset($_SESSION['signin']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form action="<?= ROOT_URL ?>signin-logic.php" autocomplete="off" method="POST">
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="text" name="email" required autocomplete="new-email"
                    value="<?= $email ?>" placeholder=" ">
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" name="password" required autocomplete="new-password"
                    value="<?= $password ?>" placeholder=" ">
                    <label>Password</label>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox">
                    Remember me</label>
                    <a href="#">Forget Password?</a>
                </div>
                <button type="submit" name="submit" class="btn">Sign In</button>
                
        </div>
    </div>

    <script src="js/signin.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
