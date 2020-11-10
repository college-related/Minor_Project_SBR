<?php

    function decryptData($data, $key){
        $encryption_key = base64_decode($key);
        list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2),2,null);
        $decryptedData = openssl_decrypt($encrypted_data, "aes-256-cbc", $encryption_key, 0, $iv);

        return $decryptedData;
    }

    if(!isset($_GET['Logged'])){
        header("location: ../Landing.php?NotLogged");
    }

    require "../PHP/connection.php";

    session_start();

    $uId = $_SESSION['uId'];

    // $sql_detail = "SELECT form.*, basic_data.* FROM form JOIN basic_data ON form.PHN = basic_data.PHN WHERE form.PHN = '$ph' && basic_data.PHN = '$ph';";
    // $detail_result = mysqli_query($connect, $sql_detail);

    // $infoarray = mysqli_fetch_all($detail_result, MYSQLI_ASSOC);

    $sql_info = "SELECT users.ADDRESS, users.CITIZEN, users.NAME, users.PHN, vehicle_data.* FROM users JOIN vehicle_data ON users.uId=vehicle_data.uId WHERE users.uId='$uId' && vehicle_data.uId='$uId'";
    $info_result = mysqli_query($connect, $sql_info);

    $infoarray = mysqli_fetch_all($info_result, MYSQLI_ASSOC);

    $key_sql = mysqli_fetch_all(
        mysqli_query(
            $connectKey,
            "SELECT * FROM user_key WHERE uId = '$uId'"
        ),
        MYSQLI_ASSOC
    );

    $key = $key_sql[0]['userKey'];
    $str = $key_sql[0]['userStr'];

    $sql_form = "SELECT * FROM form WHERE uId='$uId';";
    $form_result = mysqli_query($connect, $sql_form);

    // $sql_detail= "SELECT * FROM vehicle_data WHERE uId='$uId';";
    // $detail_result = mysqli_query($connect, $sql_detail);

    $sql_tax="SELECT * FROM tax_data WHERE uId ='$uId';";
    $tax_result=mysqli_query($connect,$sql_tax);

    $sql_image="SELECT image_name FROM images WHERE uId='$uId';";
    $image_result=mysqli_query($connect,$sql_image);

    $imageArray=mysqli_fetch_all($image_result,MYSQLI_ASSOC);
    if($imageArray != null){
        $img = $imageArray[0]['image_name'];
        $image_src = "../ASSETS/upload/" . $img;
    }

    $formArray = mysqli_fetch_all($form_result,MYSQLI_ASSOC);
    // $infoarray = mysqli_fetch_all($detail_result,MYSQLI_ASSOC);
    // print_r($infoarray);
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
                            <input type="hidden" value="<?= $key ?>"  name ="key">
                        </td>
                    </tr>
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
                       echo decryptData($infoarray[0]['NAME'],$key);
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
                        
                        if(empty($infoarray)){
                            echo "???";
                        }else{
                            echo decryptData($infoarray[0]['PHN'],$key);
                        }
                        
                        ?> </td>
                    </tr>
                    <tr>
                        <td>Citizenship number :</td>
                        <td> 
                            <?php
                                if(empty($infoarray)){
                                    echo "???";
                                }else{
                                    echo decryptData($infoarray[0]['CITIZEN'],$key);
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Address :</td>
                        <td>
                            <?php
                                if(empty($infoarray)){
                                    echo "???";
                                }else{
                                    echo decryptData($infoarray[0]['ADDRESS'],$key);
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Vehicle Type:</td>
                        <td> 
                            <?php    
                                if(empty($infoarray) || $infoarray[0]['VEHICLE_TYPE'] == ""){
                                    echo "???";
                                }else{
                                    echo $infoarray[0]['VEHICLE_TYPE'];
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Vehicle Category :</td>
                        <td>
                            <?php
                                if(empty($infoarray) || $infoarray[0]['VEHICLE_CATEGORY'] == ""){
                                    echo "???";
                                }else{
                                    echo $infoarray[0]['VEHICLE_CATEGORY'];
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>ENGINE_CC :</td>
                        <td> 
                            <?php
                                 if(empty($infoarray) || $infoarray[0]['ENGINE_CC'] == ""){
                                    echo "???";
                                }else{
                                    echo $infoarray[0]['ENGINE_CC'];
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Vehicle Registration no. :</td>
                        <td> 
                            <?php
                                 if(empty($infoarray) || $infoarray[0]['VEHICLE_REG'] == ""){
                                    echo "???";
                                }else{
                                    echo decryptData($infoarray[0]['VEHICLE_REG'],$key);
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