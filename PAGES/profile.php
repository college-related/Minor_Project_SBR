<?php

    if(!isset($_GET['Logged'])){
        header("location: ../Landing.php?NotLogged");
    }

    require "../PHP/connection.php";

    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/profile.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <!-- font links -->
    <link href="https://fonts.googleapis.com/css2?family=ZCOOL+XiaoWei&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mukta+Malar&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kalam&display=swap" rel="stylesheet">

    <script defer src="../JS/category_type.js"></script>
</head>
<body>
    <header>

        <!-- logo and website name -->
        <span id="logo">SWIFT BLUEBOOK RENEW</span>

        <!-- navigation bar for desktop view -->
        <nav class="web-navigation">
            <a href="./information.php?isLogged=true">Infos</a>
            <a href="./form.html">Form</a>
            <a href="../php/logout.php">LogOut</a>
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

    <!-- <div class="nav-hero"> -->
        <!-- hero text(website name) -->
        <!-- <h1 class="hero-text headings">
            PROFILE
        </h1>
    </div> -->

    <!-- wave sturcture below header-->
    <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#7293b5" fill-opacity="1" d="M0,224L48,197.3C96,171,192,117,288,96C384,75,480,85,576,101.3C672,117,768,139,864,160C960,181,1056,203,1152,202.7C1248,203,1344,181,1392,170.7L1440,160L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg> -->

    <main>
        <!-- TODO -->
    </main>
 
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
             <span>
                 <i class="fab fa-facebook"></i>
             </span>
             <span>
                 <i class="fab fa-chrome"></i>
             </span>
             <span>
                 <i class="fas fa-fax"></i>
             </span>
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