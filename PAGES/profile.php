<?php

    if(!isset($_GET['Logged'])){
        header("location: ../Landing.php?NotLogged");
    }

    require "../PHP/connection.php";

    session_start();

    $ph = $_SESSION['phone'];

    // $sql_detail = "SELECT form.*, basic_data.* FROM form JOIN basic_data ON form.PHN = basic_data.PHN WHERE form.PHN = '$ph' && basic_data.PHN = '$ph';";
    // $detail_result = mysqli_query($connect, $sql_detail);

    // $detailArray = mysqli_fetch_all($detail_result, MYSQLI_ASSOC);
    $sql_form = "SELECT * FROM form WHERE PHN='$ph';";
    $form_result = mysqli_query($connect, $sql_form);

    $sql_detail= "SELECT * FROM basic_data WHERE PHN1='$ph';";
    $detail_result = mysqli_query($connect, $sql_detail);

    $sql_tax="SELECT * FROM fine WHERE PHN ='$ph';";
    $tax_result=mysqli_query($connect,$sql_tax);

    $formArray = mysqli_fetch_all($form_result,MYSQLI_ASSOC);
    $detailArray = mysqli_fetch_all($detail_result,MYSQLI_ASSOC);
    $taxArray = mysqli_fetch_all($tax_result,MYSQLI_ASSOC);
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

    
    <style>
        #closeBtn-holder{
            display:<?php
            if(isset($_GET['signed'])){
                echo "none;";
            }
            else{
                echo "block;";
            }
            ?>
            text-align:right;
        }
        .information{
            display:
            <?php
            if(isset($_GET['signed'])){
                echo "block;";
            }
            else{
                echo "none;";
            }
            ?>
        }
        #close-mark{
            text-align:right;
            font-size:40px;
            color:white;
        }
        #close-mark,.fa-edit{
            cursor:pointer;
        }
        <?php
        if(isset($_GET['signed'])){
            echo ".detail-popup, .bg-overlay{
                display:block;
                 }";
        }
        ?>

    </style>
    <script defer src="../JS/detail_popup.js"></script>
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

    <div class="nav-hero">
        <h1 class="hero-text headings">
            PROFILE
        </h1>
    </div>
    <!-- wave sturcture below header-->
    <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#7293b5" fill-opacity="1" d="M0,224L48,197.3C96,171,192,117,288,96C384,75,480,85,576,101.3C672,117,768,139,864,160C960,181,1056,203,1152,202.7C1248,203,1344,181,1392,170.7L1440,160L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg> -->
   
   <div class="bg-overlay"></div>
   
    <div class="detail-popup">
        <div class="information"><P>Fill Up the data please</P></div>
        <div id="closeBtn-holder">
            <span id="close-mark" onclick="closedEditPopup()">
            &times;
            </span>
    </div>
    <form action="../PHP/handleBasicdata.php" method="POST">
                <table>
                    <tr>
                        <td>
                            <label for="vehicle-type">Vehicle Type</label>
                        </td>
                        <td>
                        <select name="vType" id="vehicle-type" onchange="changingType('vehicle-type', 'vehicle-name')" required>
                                <option value="none"></option>
                                <option value="twoWheel">Two wheeler</option>
                                <option value="fourWheel">Four wheeler</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="vehicle-name">Vehicle Category</label>
                        </td>
                        <td><select name="vCategory" id="vehicle-name" required></select></td>
                    </tr>
                    <tr>
                        <td>
                            <label for="engine-cc">Engine cc</label>
                        </td>
                        <td><input type="number" name="ECC" id="engine-cc" placeholder="Ex: 150"></td>
                    </tr>
                   
                    <tr>
                        <td>
                            <label for="registration-no">Vehicle Registration Number </label>
                        </td>
                        <td><input type="text" name="regNo" id="registration-no" placeholder="GA 16 PA 4381"></td>
                    </tr>
                   
                    <tr>
                        <td > 
                      </td>
                        <td class="btn-td" colspan=2>
                            <input type="submit" name="savebtn" class="editsavebtn" value="SAVE">
                        </td>
                    </tr>
                </table>
            </form>
    </div>
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
                <table>
                    <tr>
                        <td>Phone number :</td>
                        <td> <?=$detailArray[0]['PHN1']?> </td>
                    </tr>
                    <tr>
                        <td>Vehicle Type:</td>
                        <td> <?=$detailArray[0]['VEHICLE_TYPE1']?></td>
                    </tr>
                    <tr>
                        <td>Vehicle Category :</td>
                        <td> <?=$detailArray[0]['VEHICLE_CAT1']?></td>
                    </tr>
                    <tr>
                        <td>ENGINE_CC :</td>
                        <td> <?=$detailArray[0]['ENGINE_CC1']?></td>
                    </tr>
                    <tr>
                        <td>Vehicle Registration no. :</td>
                        <td> <?=$detailArray[0]['VEHICLE_REG1']?></td>
                    </tr>
                </table>
          <div class="editBtn">
          <i class="fa fa-edit" onclick="openEditPopup()">Edit</i>
          </div>
        </div>
           
        </div>

        <div id="more-details" class="maindiv">
            <h3><u> MORE DETAILS</u></h3>
            <div id="latest-form">
                <h4>Latest Form</h4>
                <?php foreach($formArray as $data) { ?>
                    <table class="form-table">
                        <tr>
                            <td>Name :</td>
                            <td> <?=$data['NAME']?></td>
                            <td>Phone number :</td>
                            <td> <?=$data['PHN']?></td>
                        </tr>
                        <tr>
                            <td>Vehicle Type :</td>
                            <td> <?=$data['VEHICLE_TYPE']?></td>
                            <td>Vehicle Category :</td>
                            <td>  <?=$data['VEHICLE_CAT']?></td>
                        </tr>
                        <tr>
                            <td> Engine CC :</td>
                            <td> <?=$data['ENGINE_CC']?></td>
                            <td> Vehicle Registration no. :</td>
                            <td> <?=$data['VEHICLE_REG']?></td>
                        </tr>
                        <tr>
                            <td colspan="2">Last Renew Date</td>
                            <td colspan="2"><?=$data['RENEW_DATE']?></td>
                        </tr>
                    </table>
                <?php } ?>
            </div>
            <div class="tax-info">
                    <table>
                        <tr>
                            <th>YEAR</th>
                            <th>FINE</th>
                            <th>TAX AMOUNT</th>
                        </tr>
                     <?php 
                     if(sizeof($taxArray) < 3){
                        foreach($taxArray as $data) {?>
                            <tr>
                                <td>
                                    <?= $data['YEAR']?>
                                </td>
                                <td>
                                    <?= $data['FINE']?>
                                </td>
                                <td>
                                    <?= $data['TAX_AMOUNT']?>
                                </td>
                            </tr>
                     
                        <?php }
                     }else{
                         for($i= sizeof($taxArray)-1; $i > sizeof($taxArray)-4;$i--){ ?>
                             <tr>
                                <td>
                                    <?= $taxArray[$i]['YEAR']?>
                                </td>
                                <td>
                                    <?= $taxArray[$i]['FINE']?>
                                </td>
                                <td>
                                    <?= $taxArray[$i]['TAX_AMOUNT']?>
                                </td>
                            </tr>
                     
                         <?php }  } ?>
                    </table>
            </div>
        </div>
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