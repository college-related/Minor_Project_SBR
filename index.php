<?php
    if(isset($_GET['error'])){
        $error = $_GET['error'];
        $title = "Error";
        
        if($error == 'EmailNotVerified'){
            $icon = "<i class='far fa-tired fa-2x'></i>";
            $mssg = "Please verify your email first.";
        }elseif($error == 'IllegalWay'){
            $icon = "<i class='far fa-angry fa-2x'></i>";
            $mssg = "Illegal Entry Denied!!!";
        }
    }

    if(isset($_GET['mssg'])){
        $successMssg = $_GET['mssg'];
        $title = "Hurray!";

        if($successMssg == 'Verified'){
            $icon = "<i class='far fa-grin-beam fa-2x'></i>";
            $mssg = "Your email is verified, you can log in.";
        }else if($successMssg == 'AlreadyVerified'){
            $icon = "<i class='far fa-laugh-wink fa-2x'></i>";
            $mssg = "Your email is already verified, you can log in.";
        }
    }

    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SWIFT BLUEBOOK RENEW</title>

    <link rel="stylesheet" href="./CSS/new-css/style.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <style>
        <?php if(isset($_GET['inputError']) && $_GET['inputError'] == 'WrongPass') { ?>
            #password-field {
                border: 1px solid #CA0B00;
            }
        <?php } ?>
        <?php if(isset($_GET['inputError']) && $_GET['inputError'] == 'WrongEmailOrUser') { ?>
            #name-field {
                border: 1px solid #CA0B00;
            }
        <?php } ?>
    </style>
</head>

<body>
    <?php include("./repeated_section/header.php") ?>
    <?php 
        if(isset($_GET['error'])) {
            include("./repeated_section/error.php");
        }
    ?>
   
    <!-- main section -->
    <main class="container">
        <div class="row-2 hero-holder">
            <div class="col-1 hero-div text-center">
                <h1>Swift BlueBook Renew</h1>
                <h3>Less Line Less Waiting</h3>
                <a href="./register.php">
                    <button class="btn btn-primary btn-hero">Get Started</button>
                </a>
            </div>
            <div class="col-1" class="feature-img">
                <img src="./ASSETS/IMAGES/undraw/landing-hero.png" alt="girl sitting in a car" class="feature-img">
            </div>
        </div>
        <div class="row-3 feature-holder">
            <div class="col-1">
                <div class="feature-img">
                    <img src="./ASSETS/IMAGES/undraw/secure.png" alt="secure and safe" class="feature-img">
                </div>
                <div class="feature-description">
                    <h4 class="text-center">Secure and Safe</h4>
                    <p>
                        Don't Worry your data are safe
                        and secure through our database
                        level encryption and email based
                        authentication. You are the only 
                        one who can access them.
                    </p>
                </div>
            </div>
            <div class="col-1">
                <div class="feature-img">
                    <img src="./ASSETS/IMAGES/undraw/digitalized.png" alt="digitalized" class="feature-img">
                </div>
                <div class="feature-description">
                    <h4 class="text-center">Digitalized</h4>
                    <p>
                        By Digitalizing the data we are
                        not only making the data reliable
                        and safe but also fast. All you 
                        need is few minutes to fill the 
                        form and its done.
                    </p>
                </div>
            </div>
            <div class="col-1">
                <div class="feature-img">
                    <img src="./ASSETS//IMAGES/undraw/reminder.png" alt="reminder" class="feature-img">
                </div>
                <div class="feature-description">
                    <h4 class="text-center">Reminders</h4>
                    <p>
                        Link your email account and the
                        next time its time to pay the bill
                        you got our back we will remind
                        you on time. 
                    </p>
                </div>
            </div>
        </div>
        <div class="row-2 form-holder" id="form-wrapper">
            <div class="col-1" class="feature-img" id="login-img">
                <img src="./ASSETS/IMAGES/undraw/login.png" alt="girl by the tree" class="feature-img">
            </div>
            <div class="col-1">
                <div class="form" >
                    <h2 class="form-title">Log In</h2>
                    <div class="form-body">
                        <form action="./PHP/handleLogUser.php" method="POST">
                            <div class="form-group">
                                <input class="form-field" type="text" placeholder="UserName or Email" name="user" id="name-field" required/>
                                <?php if(isset($_GET['inputError']) && $_GET['inputError'] == 'WrongEmailOrUser') { echo "<span class='text-danger'><i class='fas fa-exclamation-circle'></i> The credential is not correct</span>"; } ?>
                            </div>
                            <div class="form-group">
                                <input class="form-field" type="password" placeholder="Password" name="Password" id="password-field" required/>
                                <?php if(isset($_GET['inputError']) && $_GET['inputError'] == 'WrongPass') { echo "<span class='text-danger'><i class='fas fa-exclamation-circle'></i> The password is incorrect</span>"; } ?>
                            </div>
                            <div class="form-group text-center">
                                <input type="submit" value="Log In" name="login" class="btn btn-accent"/>
                            </div>
                        </form>
                    </div>
                    <div class="form-footer text-center">
                        <p>Don't have a account? <a href="./register.php" class="link-primary">Create one</a></p>
                        <a href="./PAGES/forgetPassword.php" class="link-underline">Forgot Password?</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include('repeated_section/mobile-header.php') ?>
    <?php include('repeated_section/footer.html') ?>

    <script>
        function closeErrorPopUp(){
            document.getElementsByClassName('error-popup')[0].style.display = 'none';
        }
    </script>
    <script src="./JS/new-js/mobile-menu.js"></script>
    <script src="./JS/new-js/theme.js"></script>
</body>

</html>
