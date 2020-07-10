<?php

    if(isset($_GET['LogedIn'])){
        echo '<script type="text/Javascript">
                alert("Sign up or Log in First");
                </script>';
    }else if(isset($_GET['logedOut'])){
        echo '<script type="text/Javascript">
                alert("Loged out Successfully");
                </script>';
    }

?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SWIFT BLUEBOOK RENEW</title>

    <link rel="stylesheet" href="./CSS/style.css">

    <!-- font links -->
    <link href="https://fonts.googleapis.com/css2?family=ZCOOL+XiaoWei&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mukta+Malar&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kalam&display=swap" rel="stylesheet">

    <style>

        .feature-section {
            display: grid;
            grid-template-columns: 1fr 2fr;
            margin: 10px;
            background-color: #4D77A1;
            padding: 10px;
            border-radius: 10px;
            color: white;   
            text-align: justify;
            box-shadow: 1px 4px 2px lightgray;
        }

        #feature-text, .qr-fe, .fast-fe {
            grid-column: 3/7;
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

        /* signup and login form */
        .form {
            grid-column: 5/9;
            background-color: #7293B5;
            padding: 20px 10px;
            margin-top: 150px;
            color: white;
            text-align: center;
            box-shadow: 
                0 15px 40px 0 rgba(166, 173, 201, .2)
                0 5px 10px 0 rgba(154, 160, 185, .05);
        }

        /* input field */
        input {
            margin: 5px auto;
            padding: 10px;
            border: none;
            border-radius: 10px;
            width: max-content;
        }

        /* log in form */
        #loginForm {
            display: none;
        }

        #toLogLink, #toSignLink {
            background-color: inherit;
            border: none;
            color: white;
            font-size: medium;
            cursor: pointer;
        }

    </style>

    <script defer src="./JS/sign_log.js"></script>

</head>

<body>
    <!-- head of the website -->
    <header>

        <!-- logo and website name -->
        <span id="logo">SWIFT BLUEBOOK RENEW</span>

        <!-- navigation bar for desktop view -->
        <nav class="web-navigation">
            <a href="#">Home</a>
            <a href="./FRONT_END/HTML/information.html">Infos</a>
            <a href="#signupForm">SignUp</a>
            <!-- <a href="#loginForm">LogIn</a> -->
        </nav>

        <!-- navigation bar for mobile view -->
        <nav class="mobile-navigation">
            <ul>
                <li>Home</li>
                <li>Infos</li>  
                <li>SignUp</li>
                <li>LogIn</li>
            </ul>
        </nav>

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
            <button id="hero-btn">GET STARTED</button>
        </a>

    </header>

    <!-- wave sturcture below header-->
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#7293b5" fill-opacity="1" d="M0,224L48,197.3C96,171,192,117,288,96C384,75,480,85,576,101.3C672,117,768,139,864,160C960,181,1056,203,1152,202.7C1248,203,1344,181,1392,170.7L1440,160L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>

    <!-- main section -->
    <main>
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

        <!-- sign up form -->
        <div class="form" id="signupForm">
        <form action="./BACK_END/handleUser.php" method="POST">
            <h2>Sign Up</h2>
            <input type="email" placeholder="Email" name="Email"/>
            <input type="text" placeholder="Username" name="Uname"/><br/>
            <input type="number" placeholder="Phone Number" name="Phn" />
            <input type="text" placeholder="Address" name="Address" /><br/>
            <label for="dob">Date of Birth : </label>
            <input type="date" placeholder="Date of Birth" name="DOB" id="dob"/><br/>
            <input type="password" placeholder="Password" name="Password"/>
            <input type="password" placeholder="Confrim Password" name="Repass"/><br/>
            <input type="submit" value="Sign Up" name="signup"/><br/>
        </form>
        <button id="toLogLink">Log in</button>
        </div>

        <!-- log in form -->
        <div class="form" id="loginForm">
        <form action="./BACK_END/handleLogUser.php" method="POST">
            <h2>Log In</h2>
            <input type="text" placeholder="Username" name="Uname"/><br/>
            <input type="password" placeholder="Password" name="Password"/><br/>
            <input type="submit" value="Log In" name="login"/><br/>
        </form>
        <button id="toSignLink">Sign Up</button>
        </div>

    </main>

    <!-- wave structure above footer-->
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#7293b5" fill-opacity="1" d="M0,192L48,197.3C96,203,192,213,288,202.7C384,192,480,160,576,133.3C672,107,768,85,864,96C960,107,1056,149,1152,144C1248,139,1344,85,1392,58.7L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
    
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

    <!-- foot of the website -->
    <footer>

        <!-- contact part -->
        <div class="contact-section">
            <h3>Contact us</h3>
            <address>
<pre>
Tel-phn: +06100012
Email: liscense@email.com
Fax: 01-001212
</pre>
            </address>
            <span>F</span>
            <span>E</span>
            <span>W</span>
        </div>

        <!-- about part -->
        <div class="about-section">
            <h3>About us</h3>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Est eos perferendis corporis dolore sit qui possimus nobis eligendi, maxime amet tempore quo quod, similique in unde adipisci aspernatur autem assumenda?
                Harum, explicabo, dignissimos eum odio suscipit optio laboriosam voluptatem dolor nostrum libero quam architecto? Minima deserunt corporis id at? Sint, ipsa mollitia.
            </p>
        </div>

    </footer>

</body>

</html>
