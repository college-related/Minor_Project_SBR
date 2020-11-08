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

    $sql_image="SELECT image_name FROM images WHERE PHN='$ph';";
    $image_result=mysqli_query($connect,$sql_image);

    $imageArray=mysqli_fetch_all($image_result,MYSQLI_ASSOC);
    if($imageArray != null){
        $img = $imageArray[0]['image_name'];
        $image_src = "../ASSETS/upload/" . $img;
    }

    $formArray = mysqli_fetch_all($form_result,MYSQLI_ASSOC);
    $detailArray = mysqli_fetch_all($detail_result,MYSQLI_ASSOC);
    // print_r($detailArray);
    // die();

    $taxArray = mysqli_fetch_all($tax_result,MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

    <link rel="stylesheet" href="../CSS/search.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/profile.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <!-- font links -->
    <link href="https://fonts.googleapis.com/css2?family=ZCOOL+XiaoWei&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mukta+Malar&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kalam&display=swap" rel="stylesheet">

    
    <style>
        #closeBtn-holder{
            display:block;
            text-align:right;
        }
        
        #close-mark{
            text-align:right;
            font-size:40px;
            color:white;
        }
        #close-mark,.fa-edit{
            cursor:pointer;
        }

    </style>
    <script defer src="../JS/detail_popup.js"></script>
    <script defer src="../JS/category_type.js"></script>
    <script defer src="../JS/search.js"></script>
    <script defer src="../JS/profile.js"></script>
</head>
<body class="col-12">
    <header class="col-12">

        <!-- logo and website name -->
        <span id="logo">SWIFT BLUEBOOK RENEW</span>

        <!-- navigation bar -->
        <nav>
            <ul>
                <li><a href="./information.php?isLogged=true">Infos</a></li>
                <li><a href="./form.php">Form</a></li>
                <li><a href="#" class="active-nav-link">Profile</a></li>
                <li><a href="../php/logout.php">LogOut</a></li>
                <li><i class="fa fa-search"></i></li>
            </ul>
        </nav>

    </header>

    <!-- <div class="nav-hero col-12">
        <h1 class="hero-text headings">
            PROFILE
        </h1>
    </div> -->
    
    <?php include '../repeated_section/search.html'; ?>

   <div class="bg-overlay"></div>
   
    <div class="detail-popup">
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
    <main class="col-12">
    <div class="profile-wrapper">
        <div class="profile-side-section">
            <div id="user-name">
                <h4>
                    <?php
                        echo $_SESSION['Uname'];
                    ?>
                </h4>
            </div>

            <div class="profile-photo-wrapper">
                <div id="add-photo">
                    <!-- <?php
                        if($imageArray == null){
                            echo "
                                <form action='../PHP/handleImage.php' method='POST' enctype='multipart/form-data'>
                                    <input type='file' name='img' onchange='this.form.submit();' id='image_adder'>
                                    <label for='image_adder'> <i class='far fa-image'> </i> Upload Image<lable>
                                </form>
                            ";
                        }else{
                            echo "<img src='$image_src' alt='profile picture' id='profile_picture'>";
                        }
                    ?> -->
                </div>
            </div>

            <div class="profile-btn-wrapper">
                <button class="btn basic-btn active-btn">Basic Details</button>
                <button class="btn tax-btn">Tax Details</button>
                <button class="btn latest-form-btn">Latest Form Detail</button>
            </div>
        </div>

        <div class="profile-detail-section basic-detail">
        
            <div class="detail-form">
            <h3><u> DETAILS</u></h3>
                <table>
                    <tr>
                        <td>Phone number :</td>
                        <td> <?php 
                        
                        if(empty($detailArray)){
                            echo "???";
                        }else{
                            echo $detailArray[0]['PHN1'];
                        }
                        
                        ?> </td>
                    </tr>
                    <tr>
                        <td>Citizenship number :</td>
                        <td> ???
                            <!-- <?php
                                if(empty($detailArray)){
                                    echo "???";
                                }else{
                                    echo $detailArray[0]['CITIZEN'];
                                }
                            ?> -->
                        </td>
                    </tr>
                    <tr>
                        <td>Address :</td>
                        <td>???
                            <!-- <?php
                                if(empty($detailArray)){
                                    echo "???";
                                }else{
                                    echo $detailArray[0]['ADDRESS'];
                                }
                            ?> -->
                        </td>
                    </tr>
                    <tr>
                        <td>Vehicle Type:</td>
                        <td> 
                            <?php    
                                if(empty($detailArray) || $detailArray[0]['VEHICLE_TYPE1'] == ""){
                                    echo "???";
                                }else{
                                    echo $detailArray[0]['VEHICLE_TYPE1'];
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Vehicle Category :</td>
                        <td>
                            <?php
                                if(empty($detailArray) || $detailArray[0]['VEHICLE_CAT1'] == ""){
                                    echo "???";
                                }else{
                                    echo $detailArray[0]['VEHICLE_CAT1'];
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>ENGINE_CC :</td>
                        <td> 
                            <?php
                                 if(empty($detailArray) || $detailArray[0]['ENGINE_CC1'] == ""){
                                    echo "???";
                                }else{
                                    echo $detailArray[0]['ENGINE_CC1'];
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Vehicle Registration no. :</td>
                        <td> 
                            <?php
                                 if(empty($detailArray) || $detailArray[0]['VEHICLE_REG1'] == ""){
                                    echo "???";
                                }else{
                                    echo $detailArray[0]['VEHICLE_REG1'];
                                }
                            ?>
                       </td>
                    </tr>
                </table>
          <div class="editBtn">
          <i class="fa fa-edit" onclick="openEditPopup()">Edit</i>
          </div>
        </div>           
        </div>

        <div class="profile-detail-section tax-detail">
            <div class="detail-form">
                <h3><u>Tax Detail</u></h3>
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
                <div class="slider-wrapper editBtn">
                    <span>&lt;</span>
                    <span>&gt;</span>
                </div>
            </div>
        </div>

        <div class="profile-detail-section form-detail">
            <div class="detail-form">
                <h3><u>Latest Form</u></h3>
                <div class="form-template">
                
                </div>
            </div>
        </div>


        <!-- <div id="more-details" class="maindiv">
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
        </div> -->
        </div>
    </main> 
     
    <?php include '../repeated_section/footer.html' ?>
 
</body>
</html>