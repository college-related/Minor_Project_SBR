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

    <link rel="stylesheet" href="./CSS/new-css/style.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>

<body>
    <?php include("./repeated_section/header.php") ?>
   
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
            <div class="col-1">
                <img src="./ASSETS/IMAGES/undraw/landing-hero.png" alt="" width="600">
            </div>
        </div>
        <div class="row-3 feature-holder">
            <div class="col-1">
                <div class="feature-img">
                    <img src="./ASSETS/IMAGES/undraw/secure.png" alt="" width="300">
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
                    <img src="./ASSETS/IMAGES/undraw/digitalized.png" alt="" width="300">
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
                    <img src="./ASSETS//IMAGES/undraw/reminder.png" alt="" width="300">
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
        <div class="row-2" id="form">
            <div class="col-1">
                <img src="./ASSETS/IMAGES/undraw/login.png" alt="" width="600">
            </div>
            <div class="col-1">
                <div class="form" >
                    <h2 class="form-title">Log In</h2>
                    <div class="form-body text-center">
                        <form action="./PHP/handleLogUser.php" method="POST">
                            <input class="form-field" type="text" placeholder="UserName or Email" name="user" required/>
                            <input class="form-field" type="password" placeholder="Password" name="Password" required/>
                            <input type="submit" value="Log In" name="login" class="btn btn-primary btn-accent"/>
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

    <?php include('repeated_section/footer.html') ?>

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
