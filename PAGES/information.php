<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Information</title>

    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/information_style.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

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

                    $log = $_GET['isLogged'];

                    if($log=="true"){

                        echo "<a href='./form.html'>Form</a> <a href='./profile.php?Logged'>Profile</a> <a href='../php/logout.php'>LogOut</a>";

                    }
                    elseif($log=="false"){
                        echo "<a href='../landing.php#signupForm'>SignUp</a> <a href='../landing.php?logBox#loginForm'>LogIn</a>";

                        
                    }

                }else{
                    header("Location: ../landing.php");
                }
           
           ?>
            <!-- <a href="#loginForm">LogIn</a> -->
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
            INFORMATION
        </h1>
    </div>

    <!-- wave sturcture below header-->
    <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#7293b5" fill-opacity="1" d="M0,224L48,197.3C96,171,192,117,288,96C384,75,480,85,576,101.3C672,117,768,139,864,160C960,181,1056,203,1152,202.7C1248,203,1344,181,1392,170.7L1440,160L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg> -->

    <main>
        <div id="detail_related">
            <h3>
                Details Related
            </h3>
            <ul>
               
                It consists of the details after login or signup to our webpage. What kind of features does it have and what of its use for users.
                <li>
                    <b>Vehicle Type</b>
                    There are various types of vehicles.Our website include two of them:  <b>Two Wheeler</b> and <b>Four Wheeler</b>.We have to choose of it give some information about our vehicle.
                </li>
                <li>
                    <b>Vehicle Catagories</b>
                    Different types of vehicle are covered by different licence categories, and have varying minimum age restrictions.</br>
                    Such as:</br>
                    Category fo car is 'B',</br>
                    Category fo scoter is 'k',</br>
                    Category fo bike is 'A' and so on.
                </li>
                <li>
                    <b>Engine CC</b>
                    The term cc in any engine is the displacement of the motor measured in cubic centimeters. It includes the details that what type of engine cc is yours.So we can evaluate your tax.
                </li>
                <li>
                    <b>Vehicle Registration</b>
                    All road vehicles with or without a motor (except bicycles) are tagged with a registration number.Licence plates are commonly known as number plates. 
                    The licence plate number is issued by the state-level Transport Management Office, a government agency under the Department of Transport Management.
                    For the purpose of vehicle registration Vehicle & Transport Management Act, 2049 (1992) and Vehicle & Transport Management Rule, 2054 (1997) of Nepal, classifies vehicles into the following 5 main categories on the basis of size and capacity.
                    Those classifications of vehicles are indicated by the color of their license plates. 
                    So,<b>Vehicle Registration</b> number means the lisence plate number which have to be provided by users to confirm their own vehicle.
                </li>
                <li>
                    <b>Last Renew Date</b>
                    We include last renew date to assume your road tax and fine tax(if needed) compared with the current time.So it will make you easy to know how much you pay for your own vehicle. 
                </li>
                <li
                ><b>Insurance</b>
                We include insurance details question because if you had not paid insurance when you visit with our details to the main office.You have to pay more than our road tax payment slip.
                </li>
                <li>
                    <b>QR Code</b>
                    Its for the easiest method for you to take details to the main office.It makes you data turn to the QR code and after scanned in the main office to will be fast to do your transiction.
                </li>
            </ul>
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
                <!-- <div class="photo"> -->
                    <img src="../ASSETS/IMAGES/insuranceimage.jpg" alt="Insurance payment photo" class="PaymentRelatedImage" width="120px" height="120px" style="border-radius:50%;">
                <!-- </div> -->
                <div class="text">
                    <h4>Insurance Payment</h4>
                    You can make payments by some online methods or by personally going to those company which deals with insurance for vehicle.
                </div>
            </div>

            <div class="payment_section">
                <!-- <div class="photo"> -->
                    <img src="../ASSETS/IMAGES/roadtaxphoto.jpg" alt="Road tax payment photo"  class="PaymentRelatedImage"  width="120px" height="120px" style="border-radius:50%;">
               <!-- </div> -->
                <div class="text">
                    <h4>Road Tax Payment</h4>
                    Its is the payment that should be paid by every individual to the goverment  as Road tax.Some of the vehicle types,catagories have its own road tax assigned by goverment.
                    </div>
            </div>

            <div class="payment_section"> 
                <!-- <div class="photo"> -->
                    <img src="../ASSETS/IMAGES/bluebookcartooneephoto.png" alt="Billbook renew photo" class="PaymentRelatedImage"  width="120px" height="120px" style="border-radius:50%;">
                <!-- </div> -->
                <div class="text">
                    <h4>BillBook Renew Payment</h4>
                Its the payment for renewing the blue book per year.   
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
                <!-- <div class="document_section_photo"> -->
                    <img src="../ASSETS/IMAGES/insurancepaymentreceipt.jpg" alt="Insurance payment document model photo" width="200px" height="150px">
                <!-- </div> -->
            </div>
            <div class="payment_section"> 
                <!-- <div class="document_section_photo_left"> -->
                    <img src="../ASSETS/IMAGES/citizenshipdocument.jpg" alt="Cittizenship Certificate document model photo"  width="200px" height="150px">
                <!-- </div> -->
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
                <!-- <div class="document_section_photo"> -->
                    <img src="../ASSETS/IMAGES/bluebookphoto.jpg" alt="Billbook renew regstration document model photo"  width="200px" height="150px">
                <!-- </div> -->
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
 
     <?php include '../repeated_section/footer.html' ?>

</body>
</html>