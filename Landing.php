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

    <!-- font links -->
    <link href="https://fonts.googleapis.com/css2?family=ZCOOL+XiaoWei&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mukta+Malar&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kalam&display=swap" rel="stylesheet">
    
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
             if($inputError == 'WrongNameORPass'){
                echo ".log-input{
                    border:1px solid red;
                }";
            }
        ?>

        #loginForm {
            display: none;
        }

        /* log in form */
        <?php
            if(isset($_GET['logBox'])){
                echo "#loginForm {
                        display: block;
                    }
                    #signupForm {
                        display: none;
                    }";
            }else{
                echo "#loginForm {
                        display: none;
                    }";
            }
        ?>

    </style>

    <script defer src="./JS/sign_log.js"></script>
    <script defer src="./JS/search.js"></script>

</head>

<body class="col-12">
    <!-- head of the website -->
    <header class="col-12">
        <!-- logo and website name -->
        <span id="logo">SWIFT BLUEBOOK RENEW</span>

        <!-- navigation bar -->
        <nav>
            <ul>
                <li><a href="./pages/information.php?isLogged=false">Infos</a></li>
                <li><a href="register.php">SignUp</a></li>
                <li><a href="#loginForm">LogIn</a></li>
                <li><i class="fa fa-search"></i></li>
            </ul>
        </nav>

    </header>

    <div class="hero-section col-12">
        <div class="hero-text">
            <!-- hero text(website name) -->
            <h1 class="hero-text headings">
                SWIFT BLUEBOOK RENEW
            </h1>

            <!-- sub heading (slogan) -->
            <h3 class="sub-text headings">
                Less Lines, Less Waiting
            </h3>

            <!-- getting started button -->
            <a href="register.php" class="hero-link">
                <button id="hero-btn">GET STARTED</button>
            </a>
        </div>
    </div>

    <?php include './repeated_section/error.php'; ?>

    <?php include './repeated_section/search.html'; ?>
   
    <!-- main section -->
    <main class="col-12">
        <div class="feature-wrapper col-12">
            <!-- features section -->
            <h2 id="feature-text">Features</h2>

            <!-- QR code section -->
            <div class="feature-section qr-fe">
                <img src="./ASSETS/images/qr.jpg" alt="illust1" class="feature-imgs">
                <div class="feature-div">
                    <h3>QR Code</h3>
                    <p>
                        The unique QR code system of our makes it easier to store the data and register them in the office.
                    </p>
                </div>
            </div>

            <!-- Secure section -->
            <div class="feature-section secure-fe">
                <img src="./ASSETS/images/secure.jpg" alt="illust2" class="feature-imgs">
                <div class="feature-div">
                    <h3>Secure Submission</h3>
                    <p>
                        The form submitted through our site are more secure and up-to date, making the work more risk free.  
                    </p>
                </div>
            </div>

            <!-- fast and reliable section -->
            <div class="feature-section fast-fe">
                <img src="./ASSETS/images/fast.jpg" alt="illust3" class="feature-imgs">
                <div class="feature-div">
                    <h3>Fast and Relaible</h3>
                    <p>
                        By using the QR code system and faster submission process, it makes the whole process easier and faster as well as relaible.
                    </p>
                </div>
            </div>

            <!-- paper management section -->
            <div class="feature-section paper-fe">
                <img src="./ASSETS/images/paper.jpg" alt="illust4" class="feature-imgs">
                <div class="feature-div">
                    <h3>Paper management</h3>
                    <p>
                        Using this new system we can lessen the amount of paper needed thus,making it more nature friendly way of work.
                    </p>
                </div>
            </div>
        </div>

        <div class="signLogSection col-12">
            <!-- advantage section -->
            <div class="advantage-section">
                <h1>Sign up to get all the advantages</h1>

                <div class="advantage-div">
                    <i>Icon</i>
                    <h3>Some advantage</h3>
                    <p>Get some advantage so sign up now.</p>
                </div>
                <div class="advantage-div">
                    <i class="fa fa-magic"></i>
                    <h3>Auto-fill</h3>
                    <p>Automatically fill up the form everytime you have to fill the form.</p>
                </div>
                <div class="advantage-div">
                    <i class="fa fa-envelope-open-text"></i>
                    <h3>Email reminder</h3>
                    <p>Get notified every year when the time arrives to renew the bluebook.</p>
                </div>
            </div>

            <div id="form-wrapper">
                <!-- sign up form -->
                <div id="signupForm">
                    <div class="form">
                    <form action="./PHP/handleUser.php" method="POST">
                        <h2>Sign Up</h2>
                        <table>
                            <tr>
                                <td><input class="form-input" type="email" placeholder="Email" name="Email" value="dummy@gmail.com" required/></td>
                            </tr>
                            <tr>
                                <td><input class="form-input" type="text" placeholder="Username" name="Uname" value="dummy" required/></td>
                            </tr>
                            <tr>
                                <td><input class="form-input" type="number" placeholder="Phone Number" name="Phn" value="1111111111" required/></td>
                            </tr>
                            <tr>
                                <td><input class="form-input" type="password" placeholder="Password" name="Password" value="12345" required/></td>
                            </tr>
                            <tr>
                                <td><input class="form-input" type="password" placeholder="Confrim Password" name="Repass" value="12345" required/></td>
                            </tr>
                            <tr>
                                <td><input type="submit" value="Sign Up" name="signup"/></td>
                            </tr>
                        </table>
                    </form>
                    <button id="toLogLink">Log in</button>
                    </div>
                </div>

                <!-- log in form -->
                <div id="loginForm">
                    <div class="form">
                    <form action="./PHP/handleLogUser.php" method="POST">
                        <h2>Log In</h2>
                        <table>
                            <tr>
                                <td><input class="form-input log-input" type="text" placeholder="Username" name="Uname" required/></td>
                            </tr>
                            <tr>
                                <td><input class="form-input log-input" type="password" placeholder="Password" name="Password" required/></td>
                            </tr>
                            <tr>
                                <td><input type="submit" value="Log In" name="login"/></td>
                            </tr>
                        </table>
                    </form>
                    <button id="toSignLink">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <!-- review section -->
    <div class="review-section col-12">

        <div class="avatar-img">
            <img src="./ASSETS/images/person_photo.jpg" alt="review-person">
        </div>

        <div class="review-comment">
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos minus iusto, magnam corrupti iste omnis itaque dolor commodi maiores quod quaerat aspernatur laborum, quisquam mollitia. Voluptatum expedita dignissimos dolore distinctio.
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Distinctio iusto tempora quos deserunt vel vitae doloribus voluptas esse dignissimos, quisquam incidunt velit modi dolores! Nulla nostrum mollitia distinctio repudiandae iste.
            </p>
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
