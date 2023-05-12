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
        <title>SMS</title>
        <link rel="stylesheet" href="<?= ROOT_URL ?>/css/signin.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    </head>
    <body>
        <!-- NAVIGATION CREATION -->
    <header>
    <h2 class="logo" >
        <a href="<?= ROOT_URL ?>signin.php">SMS</a>
    </h2>
    <nav class="navigation">
          <a href="<?= ROOT_URL ?>contact.php">Contact</a>
          <button type="submit" name="submit" class="btnLogin-popup">Sign In</button>

    </nav>
    </header>

    <div class="item">
            <div class="text-item">
                <h2>The incredibly easy, incredibly school management system<br><span>
                Save time and help students and teachers connect with others 
                </span></h2>
            </div>
            <div class="tutor-container">
                <p>
                    <div class="vid">
                        <a href="">
                            <img src="<?= ROOT_URL ?>/images/untitled.png">
                        </a>
                    </div>
                    <ul style="line-height:180%" class="advantages">
                        <li>Wiki style format enables collaboration in a single space</li>
                        <li>Questions and posts needing immediate action are highlighted</li>
                        <li>Instructors endorse answers to keep the class on track</li>
                        <li>Fast and accurate score lookup</li>
                    </ul>
                </p>
            </div>

            <div class="new_to-container">
                <p>New to SMS? Watch these videos to get started:</p>
                <div class="started_vids-container">
                    <a href="https://www.youtube.com/" class="started-link">Creating and Configuring Your Class</a>
                    <a href="https://www.youtube.com/" class="started-link">View your score</a>
                    <a href="https://www.youtube.com/" class="started-link">Posting a question</a>

                </div>
                <p>Our team is on standby to help you get started with SMS. 
                    Email us at <a class="help-link" href="https://www.google.com/intl/vi/gmail/about/">sms_support@gmail.com</a> if you need help!
                </p>
            </div>


        <footer>
            <div class="footer__socials">
                <a href="https://youtube.com" target="_blank"><i class="uil uil-youtube"></i></a>
                <a href="https://facebook.com" target="_blank"><i class="uil uil-facebook-f"></i></a>
                <a href="https://instagram.com" target="_blank"><i class="uil uil-instagram"></i></a>
                <a href="https://linkedIn.com" target="_blank"><i class="uil uil-linkedin"></i></a>
                <a href="https://twitter.com" target="_blank"><i class="uil uil-twitter"></i></a>
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
    <script src="js/main.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
