<?php
include 'partials/header.php';

// //fetch post from db if id is set
// if(isset($_GET['id'])) {
//     $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
//     $query = "SELECT * FROM posts WHERE id = $id";
//     $result = mysqli_query($connection, $query);
//     $post = mysqli_fetch_assoc($result);
// } else {
//     header('location: ' . ROOT_URL . 'blog.php');
//     die();
// }
?>
        
        <section class="singlepost">
            <div class="container singlepost__container">
                <h2>Title</h2>
                <div class="post__author"> 
                    <div class="post__author-avatar">
                        <img src="<?= ROOT_URL . 'css/' . "avatar1.jpg" ?>">  
                    </div>
                    <div class="post__author-info">
                        <h5>By: Viet Tran</h5>
                        <small>Dec 08, 2022 - 03:10</small>
                    </div>
                </div>
                    
                    
                <div class="singlepost__thumbnail">
                    <img src="<?= ROOT_URL . 'css/' . "Untitled3.png" ?>"> 
                </div>
                <p>
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. 
                    Culpa cum, nam delectus, aliquid, cupiditate aspernatur a sapiente cumque blanditiis explicabo architecto laudantium!
                    Consectetur maiores voluptatum, error esse necessitatibus architecto deleniti.
                </p>
                

            </div>
        </section>
        <div class="response-submit">
            <div class="answer-bar">
                <i class="uil uil-envelope-upload"></i>
                <h5>Student's Answer</h5>
            </div>
                <div id="textarea" onclick="showContainer()">Click to start the response</div>
                    <div class="response-container" id="response-container">
                        <div class="toolbar">
                            <div class="fileContainer">
                                <i class="uil uil-cloud-upload"></i>
                                <input type="file" onchange="handleFiles(this.files)">
                            </div>
                            <span id="fileName"></span>
                            <label for="fontSize">Font Size:</label>
                            <select id="fontSize">
                                <option value="10">10</option>
                                <option value="12">12</option>
                                <option value="14">14</option>
                                <option value="16" selected>16</option>
                                <option value="18">18</option>
                                <option value="20">20</option>
                            </select>

                            <label for="fontFamily">Font:</label>
                                <select id="fontFamily">
                                <option value="'Montserrat', sans-serif" selected>Montserrat</option>
                                <option value="Arial">Arial</option>
                                <option value="Courier New">Courier New</option>
                                <option value="Georgia">Georgia</option>
                                <option value="Times New Roman">Times New Roman</option>
                                <option value="Verdana">Verdana</option>
                            </select>

                            <button class="icon-button" onclick="alignText('left')">
                                <i class="uil uil-align-left"></i>
                            </button>
                            <button class="icon-button" onclick="alignText('center')">
                                <i class="uil uil-align-center"></i>
                            </button>
                            <button class="icon-button" onclick="alignText('right')">
                                <i class="uil uil-align-right"></i>
                            </button>

                            <button class="icon-button" onclick="formatText('bold')">
                                <i class="uil uil-bold"></i>
                            </button>
                            <button class="icon-button" onclick="formatText('italic')">
                                <i class="uil uil-italic"></i>
                            </button>
                        </div>
                        <div contenteditable="true" id="text"></div>
                        <div class="button-container">
                            <button type="submit" name="submit" action="#" method="POST">Submit</button>
                            <button onclick="hideContainer()">Cancel</button>
                        </div>
                </div>
        </div>
<!-- end of single post -->

<?php
include 'partials/footer.php';
?>