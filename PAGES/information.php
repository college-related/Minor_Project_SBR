<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Information</title>

    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/information_style.css">

    <!-- font links -->
    <link href="https://fonts.googleapis.com/css2?family=ZCOOL+XiaoWei&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mukta+Malar&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kalam&display=swap" rel="stylesheet">

</head>
<body>
     <!-- head of the website -->
     <header>

        <!-- logo and website name -->
        <span id="logo">SWIFT BLUEBOOK RENEW</span>

        <!-- navigation bar for desktop view -->
        <nav class="web-navigation">
            
           <?php
           
                if(isset($_GET['isLogged'])){
                    if(isset($_GET['isLogged']=="true")){
                        echo "<a href='./home.html'>Home</a> <a href='./form.html'>Form</a> <a href='./profile.php?Logged'>Profile</a>";

                    }
                    elseif(isset($_GET['isLogged'])=="false"){
                        echo "<a href='../landing.php'>Home</a> <a href='../landing.php?LoggedIn>SignUp</a>";
                    }
                    else{
                        header("../landing.php");
                    }
                }
           
           ?>
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
            INFORMATON
        </h1>

    </header>

    <!-- wave sturcture below header-->
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#7293b5" fill-opacity="1" d="M0,224L48,197.3C96,171,192,117,288,96C384,75,480,85,576,101.3C672,117,768,139,864,160C960,181,1056,203,1152,202.7C1248,203,1344,181,1392,170.7L1440,160L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>

    <main>
        <div id="detail_related">
            <h3>
                Details Related
            </h3>

        </div>

        <div id="insurance_related">
            <h3>
                Insurance Related
            </h3>
            <ul>
                <li>
                    <b>Insurance Type:</b>
                    We usually have two types of insurance : First Party Insurance and Third Party Insurance.</br>
                    <b>First Party Insurance </b>is obtained for the policyholder to cover losses or damages to the policyholder’s property or themselves.</br>
                    <b>Third PartyInsurance </b> is purchased to protect the insured against liability for losses or damages the insured causes to another individual or their property.
                </li>
                <li>
                    <b>Insurance Company:</b></br>
                    Insurance covers damage of the vehicle and the Third Party Liability under Comprehensive Vehicle Policy. It also covers the Personal Accident of the driver, helper, staff and the passengers.For many of us vehicle is still a luxury and damage or loss to the vehicle would mean huge investment loss that will take years to recover. If one buys the vehicle on loan, the loss would be enormous. There are various reasons which can lead to accidents and vehicle damages and sometimes it can happen without own fault. This could be true in situations where there are many vehicles and congested roads everywhere. To avoid this unpleasant situation, apply for Vehicle Insurance Policy and make the most out of it.There were many insurance company to register the insurance policy
                </li>
                <li>
                    <b>Insurance Payment:</b></br>
                    Observing this need for instant online payment options, we,Swift BuleBook Renew provide you the facility to pay your insurance premium online or you can upload the document photo of your insurance paying.
                </li>
                <li>
                    <b>Insurance Document:</b></br>
                    The slip which has been provided by the insurance company after paying the amount that have been declared by the insurance policy.After having that slip you can upload its scan document and upload it to its place needed.
                </li>
            </ul>
        </div>

        <div id="payment_related">
            <h3>
                Payment Related
            </h3>
            <div class="payment_section">
                <div class="photo">
                    <img src="#" alt="Insurance payment photo">
                </div>
                <div class="text">
                    <h4>Insurance Payment</h4>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, quod sunt porro quos odio exercitationem sint iste consectetur non accusamus error eum facere dolores nisi nostrum libero nobis. Illo, a?</div>
            </div>

            <div class="payment_section">
                <div class="photo">
                    <img src="#" alt="Road tax payment photo">
                </div>
                <div class="text">
                    <h4>Road Tax Payment</h4>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae laboriosam possimus iure quo, quos porro placeat, nobis dolores maiores cumque saepe vel consequatur. A facere magni sunt natus ipsa quos!
                </div>
            </div>

            <div class="payment_section"> 
                <div class="photo">
                    <img src="#" alt="Billbook renew photo">
                </div>
                <div class="text">
                    <h4>BillBook Renew Payment</h4>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti, officia adipisci voluptatibus nemo laborum soluta nisi optio neque consectetur labore obcaecati vitae pariatur sapiente voluptate error at aut quod sequi!
                </div>
            </div>
        </div>

        <div id="document_related">
            <h3>
                Document Related
            </h3>
            <div class="payment_section"> 
                <div class="document_section_text">
                    <h4>Insurance Payment Document</h4>
                    The slip which has been given by insurance company had to be scanned and upload to its palce where needed. Further more we will add the method of online payment of the insurance in future.
                </div>
                <div class="document_section_photo">
                    <img src="#" alt="Insurance payment document model photo">
                </div>
            </div>
            <div class="payment_section"> 
                <div class="document_section_photo_left">
                    <img src="#" alt="Cittizenship Certificate document model photo">
                </div>
                <div class="document_section_text_right">
                    <h4>Citizenship Certificate Document</h4>
                    We also need the citizentship certificate for confirmation purposes.
                </div>
            </div>
            <div class="payment_section">
                <div class="document_section_text">
                    <h4>Billbook Renew Registration Document</h4>
                    We need the bill book document for confirming the registration number provided by the user.
                </div>
                <div class="document_section_photo">
                    <img src="#" alt="Billbook renew regstration document model photo">
                </div>
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