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

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <!-- font links -->
    <link href="https://fonts.googleapis.com/css2?family=ZCOOL+XiaoWei&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mukta+Malar&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kalam&display=swap" rel="stylesheet">

    <style>
        .error{
            width:30%;
            font-size:18px;
            padding:10px;
            background-color:red;
            color:#fff;
            border:1px solid black;
            display:grid;
            grid-template-columns:1fr 4fr 1fr;
            justify-items:center;
            align-items:center;
            position:fixed;
            z-index:333;
        }


        @keyframes animateFromTop{
            from { top: 0; }
            to { top: 50px; }
        }

        @keyframes animateFromBottom{
            from { right :0; }
            to { right: 30%; }
        }

        <?php
            if(isset($_GET['error'])){
                echo ".error{
                    background-color:red;
                    animation: animateFromTop 1s ease-in-out;
                    top: 50px;
                    left: 50%;
                    transform: translateX(-50%);
                }";
            }else if(isset($_GET['mssg'])){
                echo ".error{
                    background-color:grey;
                    animation: animateFromBottom 1s ease-in-out;
                    bottom: 20px;
                    right: 30%;
                    transform: translateX(30%);
                }";
            }

        ?>

        <?php
            if(!isset($_GET['error']) && !isset($_GET['mssg'])){
                echo ".error{
                    display:none;
                }";
            }

        ?>

        <?php
            if($inputError == 'AlreadyUserEmail'){
                echo "input[type='email']{
                        border:1px solid red;
                }";
            }else if($inputError == 'PasswordNotSame'){
                echo "input[type='password']{
                        border:1px solid red;
                }";
            }else if($inputError == 'AlreadyUserPhone'){
                echo "input[type='number']{
                        border:1px solid red;
                }";
            }else if($inputError == 'WrongNameORPass'){
                echo ".log-input{
                    border:1px solid red;
                }";
            }
        ?>

        .feature-wrapper {
            padding: 40px 0;
        }

        .feature-section {
            margin: 10px;
            padding: 10px;   
            text-align: justify;
        }

        #feature-text {
            grid-column: 1/13;
            text-align: center;
        }

        .qr-fe, .fast-fe {
            grid-column: 2/7;
        }

        .secure-fe, .paper-fe {
            grid-column: 7/11;
        }

        .feature-imgs {
            width: 100px;
            height: 100px;
            padding: 20px;
        }

        .feature-div {
            padding: 2px 20px;
            line-height: 1.5rem;
        }

        .signLogSection {
            background-color: #fff;
            padding-bottom: 80px;
        }

        .advantage-section {
            grid-column: 2/7;
            margin-top: 180px;
            line-height: 2rem;
        }

        .advantage-section>h1, .advantage-section i {
            color: #111672;
        }

        .advantage-section i {
            font-size: 30px;
        }

        .advantage-div {
            margin: 30px 0;
        }

        /* signup and login form */
        .form {
            padding: 20px 50px;
            margin-top: 150px;
            text-align: center;
            box-shadow: 0px 0px 10px 5px #e2e2e2;
            line-height: 4rem;
        }

        form>table{
            width: 100%;
        }

        /* input field */
        input {
            margin: 5px auto;
            padding: 10px 30px;
            border: 1px solid lightgrey;
            width: 80%;
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

        #form-wrapper {
            grid-column: 8/12;
        }

        #loginForm, #signupForm {
            padding-top: 5px;
        }

        #toLogLink, #toSignLink {
            background-color: inherit;
            border: none;
            font-size: medium;
            cursor: pointer;
        }

    </style>

    <script defer src="./JS/sign_log.js"></script>
    <script defer src="./JS/search.js"></script>

</head>

<body>
    <!-- head of the website -->
    <header>
        <!-- logo and website name -->
        <span id="logo">SWIFT BLUEBOOK RENEW</span>

        <!-- navigation bar for desktop view -->
        <nav class="web-navigation">
            <a href="./pages/information.php?isLogged=false">Infos</a>
            <a href="#signupForm" onclick="signPopUp()">SignUp</a>
            <a href="#loginForm" onclick="logPopUp()">LogIn</a>
            <i class="fa fa-search"></i>
        </nav>

        <!-- navigation bar for mobile view -->
        <nav class="mobile-navigation">
            <ul>
                <li>Infos</li>  
                <li>SignUp</li>
                <li>LogIn</li>
            </ul>
        </nav>
    </header>

    <div class="nav-hero">
             <!-- hero text(website name) -->
        <h1 class="hero-text headings">
            SWIFT BLUEBOOK RENEW
        </h1>

        <!-- sub heading (slogan) -->
        <h3 class="sub-text headings">
            Less Lines, Less Waiting
        </h3>

        <!-- getting started button -->
        <a href="#signupForm" class="hero-link">
            <button id="hero-btn" onclick="signPopUp()">GET STARTED</button>
        </a>
    </div>
       
    <!-- wave sturcture below header-->
    <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#7293b5" fill-opacity="1" d="M0,224L48,197.3C96,171,192,117,288,96C384,75,480,85,576,101.3C672,117,768,139,864,160C960,181,1056,203,1152,202.7C1248,203,1344,181,1392,170.7L1440,160L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg> -->

        <div class="error">
            <?php echo $icon; ?>
            <div>
                <h3>
                    <?php echo $title; ?>
                </h3>
                <p>
                    <?php echo $mssg;?>
                </p>
            </div>
            <span id="errorCloseMark" onclick="closeErrorPopUp()">&times;</span>
        </div>

    <?php
    include './repeated_section/search.html';
   ?>
   
    <!-- main section -->
    <main>
        <div class="feature-wrapper">
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

        <div class="signLogSection">
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
    <div class="review-section">

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
            document.getElementsByClassName('error')[0].style.display = 'none';
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
