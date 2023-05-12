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

            <section class="feedback">
                <div class="text-item">
                    <h2>Developer Team
                        
                    </span></h2>
                </div>

                <div class="instructors-container">
                    <a class="instructor" href="https://www.facebook.com/tatviet.tran.7">
                        <img class="instructor-avatar" src="./images/avatar1.png">
                        <div class="instructor-info">
                            <p class="instructor-name">Tran Tat Viet</p>
                            <p class="instructor-subject">Information Technology
                                <br> K66-CD
                                <br> MSSV: 21020132
                                <br> Phone: 0979235038
                                <br> Email: 21020132@vnu.edu.vn
                            </p>
                        </div>
                        <div class="quote">"Kịch bản ấy đẹp, tiếc là đã không thể xảy ra được."</div>
                    </a>
                    <a class="instructor" href="https://www.facebook.com/snowshark">
                        <img class="instructor-avatar" src="./images/avatar2.png">
                        <div class="instructor-info">
                            <p class="instructor-name">Tran Xuan Truong</p>
                            <p class="instructor-subject">Information Technology
                                <br> K66-CD
                                <br> MSSV: 21020418
                                <br> Phone: 0973025514
                                <br> Email: 21020418@vnu.edu.vn
                            </p>
                        </div>
                        <div class="quote">"Trước khi khẳng định người ta sai, hay tự hỏi xem mình đã đúng chưa đã."</div>
                    </a>
                    <a class="instructor" href="https://www.facebook.com/dkt1205">
                        <img class="instructor-avatar" src="./images/avatar3.png">
                        <div class="instructor-info">
                            <p class="instructor-name">Duong Khanh Toan</p>
                            <p class="instructor-subject">Information Technology
                                <br> K66-CD
                                <br> MSSV: 21020797
                                <br> Phone: 0936587026
                                <br> Email: 21020797@vnu.edu.vn
                            </p>
                        </div>
                        <div class="quote">"Anh biết, nhưng thế là quá ít."</div>
                    </a>
                    <a class="instructor" href="https://www.facebook.com/phong.nguyentien.14224">
                        <img class="instructor-avatar" src="./images/avatar4.png">
                        <div class="instructor-info">
                            <p class="instructor-name">Nguyen Tien Phong</p>
                            <p class="instructor-subject">Information Technology
                                <br> K66-CD
                                <br> MSSV: 21020376
                                <br> Phone: 0388111003
                                <br> Email: 21020376@vnu.edu.vn
                            </p>
                        </div>
                        <div class="quote">"Đúng, nhưng chưa đủ em ạ."</div>
                    </a>
                    
                </div>
            </section>

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
