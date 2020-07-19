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
    <link rel="stylesheet" href="./profile.css">

    <!-- font links -->
    <link href="https://fonts.googleapis.com/css2?family=ZCOOL+XiaoWei&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mukta+Malar&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kalam&display=swap" rel="stylesheet">

</head>
<body>
    <header>

        <!-- logo and website name -->
        <span id="logo">SWIFT BLUEBOOK RENEW</span>

        <!-- navigation bar for desktop view -->
        <nav class="web-navigation">
            <a href="./home.html">Home</a>
            <a href="./information.php?isLogged=true">Infos</a>
            <a href="./form.html">Form</a>
            <a href="../PHP/logout.php">LogOut</a>
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
            PROFILE
        </h1>
       
    </header>

    <!-- wave sturcture below header-->
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#7293b5" fill-opacity="1" d="M0,224L48,197.3C96,171,192,117,288,96C384,75,480,85,576,101.3C672,117,768,139,864,160C960,181,1056,203,1152,202.7C1248,203,1344,181,1392,170.7L1440,160L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>

    <main>
        <div id="profile" class="maindiv">
            <div id="add-photo">
                <a href="#" id="profile-photo" style="color: black;">Add Photo</a>
            </div>
            <div id="user-name">
                <h4>
                    <?php
                        echo $_SESSION['Uname'];
                    ?>
                </h4>
            </div>
        </div>

        <div id="details" class="maindiv">
            <h3><u> DETAILS</u></h3>
            <div id="detail-form">
            <form action="">
                <table>
                    <tr>
                        <td>
                            <label for="vehicle-type">Vehicle Type</label>
                        </td>
                        <td><input type="text" name="VType" id="vehicle-type"></td>
                    </tr>
                    <tr>
                        <td>
                            <label for="engine-cc">Engine cc</label>
                        </td>
                        <td><input type="number" name="ECC" id="engine-cc"></td>
                    </tr>
                    <tr>
                        <td>
                            <label for="vehicle-name">Vehicle Name</label>
                        </td>
                        <td><input type="text" name="VName" id="vehicle-name"></td>
                    </tr>
                    <tr>
                        <td>
                            <label for="registration-no">Vehicle Registration Number </label>
                        </td>
                        <td><input type="number" name="regNo" id="registration-no"></td>
                    </tr>
                    <tr>
                        <td class="btn-td">  <input type="submit" name="savebtn" class="editsavebtn" value="SAVE" >
                      </td>
                        <td class="btn-td">
                            <input type="submit" name="editbtn" class="editsavebtn" value="EDIT">
                        </td>
                    </tr>
                </table>
            </form>
        </div>

           
        </div>

        <div id="more-details" class="maindiv">
            <h3><u> MORE DETAILS</u></h3>
            <div id="latest-form">
                <h4>Latest Form</h4>
            </div>
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