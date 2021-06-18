<?php

    if(isset($_GET['LogedIn'])){
        echo '<script type="text/Javascript">
                alert("Sign up or Log in First");
                </script>';
    }else if(isset($_GET['LoggedOut'])){
        echo '<script type="text/Javascript">
                alert("Loged out Successfully");
                </script>';
    }

    if(isset($_GET['error'])){
        $error = $_GET['error'];
        $title = "Error";
        
            if($error == 'IllegalWay'){
                $icon = "<i class='far fa-angry fa-2x'></i>";
                $mssg = "Please ! Enter through proper way.";                
            }else if($error == 'NotInserted'){
                $icon = "<i class='far fa-grin-beam-sweat fa-2x'></i>";
                $mssg = "Some error occured. Please retry.";
            }else if($error == 'NotUser'){
                $icon = "<i class='fas fa-frown fa-2x'></i>";
                $mssg = "No such user found.";
            }else if($error == 'SendMailError'){
                $icon = "<i class='far fa-sad-cry fa-2x'></i>";
                $mssg = "Some technical issue detected. Please report.";
            }else if($error == 'WrongLink'){
                $icon = "<i class='far fa-dizzy fa-2x'></i>";
                $mssg = "The link must have been expired.";
            }else if($error == 'NotActivationCode'){
                $icon = "<i class='far fa-meh fa-2x'></i>";
                $mssg = "No such activation code found.";
            }else if($error == 'EmailNotVerified'){
                $icon = "<i class='far fa-tired fa-2x'></i>";
                $mssg = "Please verify your email first.";
            }
    }

    if(isset($_GET['inputError'])){
        $inputError = $_GET['inputError'];
    }

    if(isset($_GET['mssg'])){
        $successMssg = $_GET['mssg'];
        $title = "Hurray!";

        if($successMssg == 'CheckEmail'){
            $icon = "<i class='far fa-grin-beam fa-2x'></i>";
            $mssg = "Please check your email for verification";
        }else if($successMssg == 'AlreadyVerified'){
            $icon = "<i class='far fa-laugh-wink fa-2x'></i>";
            $mssg = "User already verified";
        }
    }

    session_start();

    if(!isset($_SESSION['lang']))
        $_SESSION['lang'] = "en";
    elseif(isset($_GET['lang']) && !empty($_GET['lang']) && $_SESSION['lang'] != $_GET['lang']){
        $_SESSION['lang'] = $_GET['lang'];
    }

    $url = $_SESSION['lang'];
    
    require('Language/'.$url.'.php');
?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SWIFT BLUEBOOK RENEW</title>

    <link rel="stylesheet" href="./CSS/search.css">
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="./CSS/landing.css">
    <link rel="stylesheet" href="./CSS/error.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    
    <style>

        <?php
            if(isset($_GET['error'])){
                echo ".error-popup{
                    background-color:rgba(146,6,6,1);
                    color:#fff;
                    animation: animateFromTop 1s ease-in-out;
                    top: 50px;
                    left: 50%;
                    transform: translateX(-50%);
                }";
            }

        ?>

        <?php
            if(!isset($_GET['error'])){
                echo ".error-popup{
                    display:none;
                }";
            }

        ?>

        <?php
             if($inputError == 'WrongPass'){
                echo ".log-input-pass{
                    border:1px solid red;
                }";
            }elseif($inputError == "WrongEmailOrUser"){
                echo ".log-input-user{
                    border: 1px solid red;
                }";
            }
        ?>

        .lang-div {
            background-color: black;
            color: black;
        }

    </style>

    <script defer src="./JS/navToggle.js"></script>
    <script defer src="./JS/automatic_slides.js"></script>

</head>

    <div class="lang-div">
        <a href="index.php?lang=en">En</a>|<a href="index.php?lang=np">Np</a>
    </div>
<body class="col-12">
    <!-- head of the website -->
    <header class="col-12">
        <!-- logo and website name -->
        <span id="logo">
            <?= $lang['common']['website-name'] ?>
        </span>

        <button type="button" class="nav-toggler" id="navToggler">
            <i class="fas fa-bars"></i>
        </button>

        <!-- navigation bar -->
        <nav id="navMenu">
            <ul>
                <li><a href="./pages/information.php?isLogged=false"><?= $lang['index-page']['header-menus'][0] ?></a></li>
                <li><a href="#"><?= $lang['index-page']['header-menus'][1] ?></a></li>
                <li><a href="./PAGES/taxCalculator.php"><?= $lang['index-page']['header-menus'][2] ?></a></li>
                <li><a href="#loginForm"><?= $lang['index-page']['header-menus'][3] ?></a></li>
            </ul>
        </nav>

    </header>

    <div class="hero-section col-12">
        <div class="hero-text">
            <!-- hero text(website name) -->
            <h1 class="hero-text headings">
                <?= $lang['index-page']['hero-text'] ?>
            </h1>

            <!-- sub heading (slogan) -->
            <h3 class="sub-text headings">
                <?= $lang['index-page']['slogan-text'] ?>
            </h3>

            <!-- getting started button -->
            <a href="register.php" class="hero-link non-nav-link">
                <button id="hero-btn"><?= $lang['index-page']['hero-btn-text'] ?></button>
            </a>
        </div>
    </div>

    <?php include './repeated_section/error.php'; ?>
   
    <!-- main section -->
    <main class="col-12">
        <div class="feature-wrapper col-12">
            <!-- features section -->
            <h2 id="feature-text"><?= $lang['index-page']['feature-section']['title'] ?></h2>

            <div class="slides">
                <!-- QR code section -->
                <div class="feature-section qr-fe">
                    <img src="./ASSETS/images/qr.jpg" alt="illust1" class="feature-imgs">
                    <div class="feature-div">
                        <h3><?= $lang['index-page']['feature-section']['sub-titles'][0] ?></h3>
                        <p>
                            <?= $lang['index-page']['feature-section']['descriptions'][0] ?>
                        </p>
                    </div>
                </div>

                <!-- Secure section -->
                <div class="feature-section secure-fe">
                    <img src="./ASSETS/images/secure.jpg" alt="illust2" class="feature-imgs">
                    <div class="feature-div">
                        <h3><?= $lang['index-page']['feature-section']['sub-titles'][1] ?></h3>
                        <p>
                            <?= $lang['index-page']['feature-section']['descriptions'][1] ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="slides">
                <!-- fast and reliable section -->
                <div class="feature-section fast-fe">
                    <img src="./ASSETS/images/fast.jpg" alt="illust3" class="feature-imgs">
                    <div class="feature-div">
                        <h3><?= $lang['index-page']['feature-section']['sub-titles'][2] ?></h3>
                        <p>
                            <?= $lang['index-page']['feature-section']['descriptions'][2] ?>
                        </p>
                    </div>
                </div>

                <!-- paper management section -->
                <div class="feature-section paper-fe">
                    <img src="./ASSETS/images/paper.jpg" alt="illust4" class="feature-imgs">
                    <div class="feature-div">
                        <h3><?= $lang['index-page']['feature-section']['sub-titles'][3] ?></h3>
                        <p>
                            <?= $lang['index-page']['feature-section']['descriptions'][3] ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="signLogSection col-12">
            <!-- advantage section -->
            <div class="advantage-section">
                <h1><?= $lang['index-page']['Log-section']['title'] ?></h1>

                <div class="advantage-div">
                    <i>Icon</i>
                    <h3><?= $lang['index-page']['Log-section']['advantage-section']['0']['title'] ?></h3>
                    <p><?= $lang['index-page']['Log-section']['advantage-section']['0']['description'] ?></p>
                </div>
                <div class="advantage-div">
                    <i class="fa fa-magic"></i>
                    <h3><?= $lang['index-page']['Log-section']['advantage-section']['1']['title'] ?></h3>
                    <p><?= $lang['index-page']['Log-section']['advantage-section']['1']['description'] ?></p>
                </div>
                <div class="advantage-div">
                    <i class="fa fa-envelope-open-text"></i>
                    <h3><?= $lang['index-page']['Log-section']['advantage-section']['2']['title'] ?></h3>
                    <p><?= $lang['index-page']['Log-section']['advantage-section']['2']['description'] ?></p>
                </div>
            </div>

            <div id="form-wrapper">
                <div id="loginForm">
                    <div class="form">
                    <form action="./PHP/handleLogUser.php" method="POST">
                        <h2><?= $lang['index-page']['Log-section']['log-box-section']['title'] ?></h2>
                        <table>
                            <tr>
                                <td><input class="form-input log-input-user" type="text" placeholder="<?= $lang['index-page']['Log-section']['log-box-section']['email-placeholder'] ?>" name="user" required/></td>
                            </tr>
                            <tr>
                                <td><input class="form-input log-input-pass" type="password" placeholder="<?= $lang['index-page']['Log-section']['log-box-section']['password-placeholder'] ?>" name="Password" required/></td>
                            </tr>
                            <tr>
                                <td><input type="submit" value="<?= $lang['index-page']['Log-section']['log-box-section']['btn-text'] ?>" name="login"/></td>
                            </tr>
                        </table>
                    </form>
                    <a href="./register.php" class="non-nav-link">
                    <button id="toSignLink" class="btn">
                        <?= $lang['index-page']['Log-section']['log-box-section']['new-acc-text'] ?>
                    </button></a><br>
                    <a href="./PAGES/forgetPassword.php" class="non-nav-link"><?= $lang['index-page']['Log-section']['log-box-section']['forgot-text'] ?></a>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <div class="contact-section col-12">
        <div class="send-section">
            <h3>Send Feedback</h3>
            <form action="#" method="post">
                <table>
                    <tr>
                        <td>
                            <input type="text" name="senderName" placeholder="Name"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="email" name="senderEmail" placeholder="Email"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="mssgBox">Message:</label><br/>
                            <textarea name="senderMessage" id="mssgBox" cols="60" rows="5"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" value="Send message" name="mssgSend"/>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="contacts">
            <h3>About us</h3>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero eveniet sequi minima unde aperiam neque rerum qui suscipit in voluptatibus, ab tenetur ad expedita, quia illo eligendi delectus ipsa maiores.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel qui ducimus sit laborum? Labore explicabo quaerat quidem aut temporibus voluptates neque repudiandae sunt, delectus quo harum, veritatis optio at omnis.
            </p>
            <address>
                <label for="phoneNumber">Phone Number: </label>
                <span class="contact-span" id="phoneNumber">+061-123455</span><br/>
                <label for="emailAddress">Email: </label>
                <span class="contact-span" id="emailAddress">+061-123455</span><br/>
                <label for="faxNumber">Fax Number: </label>
                <span class="contact-span" id="faxNumber">+061-1244555</span><br/>
                <i class="fab fa-facebook"></i>
                <i class="fab fa-twitter"></i>
                <i class="fab fa-instagram"></i>
            </address>
        </div>
    </div>

    <?php include 'repeated_section/footer.html' ?>

    <script>
        function closeErrorPopUp(){
            document.getElementsByClassName('error-popup')[0].style.display = 'none';
        }

        var input = document.getElementsByClassName('form-input');

        window.addEventListener('click', function(){
            for(var i = 0; i < input.length;i++){
                input[i].style.borderColor = 'rgb(211,211,211)';
            }
        });
    </script>

</body>

</html>
