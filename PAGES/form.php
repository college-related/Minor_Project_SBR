<?php

    session_start();
    $uId = $_SESSION['uId'];
    $name = "";
    $citizen = "";
    $phn = "";
    $vehicleType = "";
    $vehicleCategory = "";
    $vehicleReg = "";
    $engineCC = "";
    $name1 = "";
    $citizen1 = "";
    $phn1 = "";
    $vehicleReg1 = "";

    require "../PHP/includes/connection.php";
    include("../PHP/includes/table_columns_name.php");
    include("../PHP/includes/encryption.php");

    if(isset($_GET['autoFill'])){
        $info = mysqli_fetch_all(
            mysqli_query(
                $connect,
                "SELECT users.$citizenship_column, users.$username_column, users.$phoneNumber_column, vehicles_data.* FROM users JOIN vehicles_data ON users.uId=vehicles_data.uId WHERE users.uId='$uId' && vehicles_data.uId='$uId'"
            ),
            MYSQLI_ASSOC
        );
    
        $str = "/6G6F;WvK7;s{au/6G6F;WvK7;s{au";
        $key = md5($str);

        // print_r($info);
        // die();

        $name = $info[0][$username_column];
        $citizen = decryptData($info[0][$citizenship_column], $key);
        $phn = decryptData($info[0][$phoneNumber_column], $key);
        $vehicleType = $info[0][$vehicleType_column];
        $vehicleCategory = $info[0][$vehicleCategory_column];
        $vehicleReg = decryptData($info[0][$vehicleRegistration_column], $key);
        $engineCC = $info[0][$engineCC_column];
        $pp = $info[0][$pp_column];
        $name1 = $name;
        $citizen1 = $citizen;
        $phn1 = $phn;
        $vehicleReg1 = $vehicleReg;
    }

    if(isset($_GET['autoOtherFill'])){
        $info = mysqli_fetch_all(
            mysqli_query(
                $connect,
                "SELECT users.$citizenship_column, users.$username_column, users.$phoneNumber_column, vehicles_data.$vehicleRegistration_column FROM users JOIN vehicles_data ON users.uId=vehicles_data.uId WHERE users.uId='$uId' && vehicles_data.uId='$uId'"
            ),
            MYSQLI_ASSOC
        );
        
        $str = "/6G6F;WvK7;s{au/6G6F;WvK7;s{au";
        $key = md5($str);

        $name1 = $info[0][$username_column];
        $citizen1 = decryptData($info[0][$citizenship_column], $key);
        $phn1 = decryptData($info[0][$phoneNumber_column], $key);
        $vehicleReg1 = decryptData($info[0][$vehicleRegistration_column], $key);
    }

    if(isset($_GET['fId'])){
        $fId = $_GET['fId'];
        $taxId = $_GET['tId'];

        $form = mysqli_fetch_all(
            mysqli_query(
                $connect,
                "SELECT * FROM forms_data WHERE $formID_column=$fId"
            ),
            MYSQLI_ASSOC
        );
    
        $str = "j-{b\b{Prd(.w4:Zj-{b\b{Prd(.w4:Z";
        $key = md5($str);

        $name = $form[0][$username_column];
        $citizen = decryptData($form[0][$citizenship_column], $key);
        $phn = decryptData($form[0][$phoneNumber_column], $key);
        $vehicleType = $form[0][$vehicleType_column];
        $vehicleCategory = $form[0][$vehicleCategory_column];
        $vehicleReg = decryptData($form[0][$vehicleRegistration_column], $key);
        $engineCC = $form[0][$engineCC_column];
        $pp = $form[0][$pp_column];
        $name1 = $form[0][$formFillerName_column];
        // $citizen1 = $citizen;
        $phn1 = decryptData($form[0][$formFillerPhn_column], $key);
        $vehicleReg1 = decryptData($form[0][$formFillerVehicleReg_column], $key);

        $lastRenew = $form[0][$renewDate_column];
        $insurance = $form[0][$insurance_column];
        $formId = $form[0][$formID_column];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <link rel="stylesheet" href="../CSS/new-css/style.css">
    <link rel="stylesheet" href="../CSS/new-css/form.css">
</head>
<body>
    <?php include('../repeated_section/header.php')?>
    <main>
        <div class="form container">
            <!-- checkbox to check if the form is for others -->
            <div class="btns">
                <div class="option justify-center">
                    <span>
                        Are you filling form for others? Check Here
                        <span id="check" onclick="reveal()">
                        <?php if(isset($_GET['autoOtherFill']) || isset($_GET['fId'])) { ?>
                            <i class="fas fa-check-circle"></i>
                        <?php }else{ ?>
                            <i class="far fa-check-circle"></i>
                        <?php } ?>
                        </span>
                    </span>
                    <form action="" method="get" id="autoFill" <?php if(isset($_GET['autoOtherFill']) || isset($_GET['fId'])) {echo "style='display:none'"; }?>>
                        <input type="submit" value="Auto-Fill" class="btn secondary btn-rounded" name="autoFill"/>
                    </form>
                    <form action="" method="get" id="autoOtherFill" style="display: <?php if(isset($_GET['autoOtherFill']) || (isset($_GET['other']) && $_GET['other'] == 'yes')) {echo "block"; }else{echo "none";}?>;">
                        <input type="submit" value="Auto-Fill" class="btn secondary btn-rounded" name="autoOtherFill"/>
                    </form>
                </div>
            </div>
            <form action="../PHP/handleForm.php" method="POST">
                <?php if(isset($formId)) {?>
                    <input type="hidden" name="fId" value="<?=$formId?>">
                    <input type="hidden" name="tId" value="<?=$taxId?>">
                <?php } ?>
                <!-- personal details section -->
                <div>
                    <!-- hidden section for others -->
                    <!-- Here we fill the users data -->
                    <div id="display" <?php if(isset($_GET['autoOtherFill']) || (isset($_GET['other']) && $_GET['other'] == 'yes')) {echo "style='display:block'"; }?>>
                        <h3 class="form-title">Please fill you information  for security purposes</h3>
                        <hr class="hr">
                        <div class="details">
                            <div class="row-2">
                                <div class="flex form-flex">
                                    <label for="name1">Name:</label>
                                    <input type="text" name="Name1" id="name1" class="form-field" value='<?=$name1?>' placeholder="Your Name" required />
                                </div>
                                <div class="flex form-flex">
                                    <label for="phn1">Phone Number:</label>
                                    <input type="number" name="Phn1" id="phn1" value="<?=$phn1?>" class="form-field"  value='<?=$phn1?>' placeholder="Your Phone Number" required/>
                                </div>
                            </div>
                            <div class="row-2">
                                <div class="flex form-flex col-2">
                                    <label  for="vehicleReg1">Vehicle Registration no:</label>
                                    <input type="text" name="VehicleReg1" id="vehicleReg1"  class="form-field" value="<?=$vehicleReg1?>" placeholder="Your Vehicle Registration Number" required/>
                                </div>
                            </div>  
                        </div>
                    </div>
                    <h3 class="form-title">Personal Information</h3>
                    <hr class="hr">
                    <div class="details">
                        <div class="row-2">
                            <div class="flex form-flex">
                                <label for="name">Name:</label>
                                <input type="text" name="Name" id="name" class="form-field" placeholder="Name" value='<?=$name?>' required/>
                            </div>
                            <div class="flex form-flex">
                                <label for="phn">Phone Number:</label>
                                <input type="number" name="Phn" id="phn" class="form-field" placeholder="Phone number" value='<?=$phn?>' required/>
                            </div>
                        </div>
                        <div class="row-2">
                            <div class="flex form-flex col-2">
                                <label for="citizen">Citizenship number:</label>
                                <input type="text" name="Citizen" id="citizen" class="form-field" placeholder="Citizenship number"  value='<?=$citizen?>' required/>
                            </div>
                        </div>  
                    </div>
                    <!-- Vechile details section -->
                    <h3 class="form-title">Vehicle Information</h3>
                    <hr class="hr"> 
                    <div class="details">
                        <div class="row-2">
                            <div class="flex form-flex">
                                <label for="type">Vehicle Type:</label>
                                <select name="Vtype" id="type" class="form-field" required>
                                    <option value="none"></option>
                                    <option value="two Wheeler" <?php if($vehicleType != ""){if($vehicleType == "two wheeler"){echo "selected";}} ?>>Two wheeler</option>
                                    <option value="four Wheeler" <?php if($vehicleType != ""){if($vehicleType == "four wheeler"){echo "selected";}} ?>>Four wheeler</option>
                                </select>
                            </div>
                            <div class="flex form-flex">
                                <label for="category">Vehicle Category:</label>
                                <select name="Vcategory" id="category" class="form-field" required>
                                    <?php
                                        if($vehicleCategory != ""){
                                            echo "<option value='$vehicleCategory'>$vehicleCategory</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="flex form-flex">
                                <label for="engine">Engine CC:</label>
                                <select name="EngineCC" id="engCC" class="form-field" required>
                                        <?php
                                            if($engineCC != ""){
                                                echo "<option value='$engineCC'>$engineCC</option>";
                                            }
                                        ?>
                                </select>
                            </div>
                            <div class="flex form-flex">
                                <label for="publicOrPrivate">Public/Private:</label>
                                <select class="form-field" name="pp" required>
                                    <option value="private" selected>
                                        Private
                                    </option>
                                    <option value="public" <?php if(isset($_GET['autoFill'])){if($pp == 'public'){echo "selected";}} ?> >
                                        Public
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="row-2">
                            <div class="col-2 flex form-flex">
                                <label for="vehicleReg">Vehicle Registration no:</label>
                                <input type="text" name="VehicleReg" id="vehicleReg" class="form-field" placeholder="Ex: GA 16 PA 4381" value='<?=$vehicleReg?>' required/>
                            </div>
                        </div>
                    </div>
                    <!-- Bluebook / insurance section -->
                    <h3 class="form-title">BlueBook Information</h3>
                    <hr class="hr">
                    <div class="details">
                        <div class="row-2">
                            <div class="flex form-flex">
                                <label for="renewDate">Last Renew Date:</label>
                                <input type="date" name="RenewDate" id="renewDate" class="form-field" required <?php if(isset($lastRenew)){echo "value='$lastRenew'";} ?>/>
                            </div>
                            <div class="flex form-flex">
                                <label for="insuranceSlip"><h4>Have you paid insurance? :</h4></label>
                                <select class="form-field" name="insuranceSlip" required>
                                    <option value="">-Select an option-</option>
                                    <option value="yes" <?php if(isset($insurance) && $insurance == 'yes'){echo "selected";} ?>>Yes</option>
                                    <option value="no" <?php if(isset($insurance) && $insurance == 'no'){echo "selected";} ?>>No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" row-2 message-holder">
                    <div>
                        <h4 class="message">Please check all the information thoroughly before submitting</h4>
                        <h4>Thank You</h4>
                    </div>   
                    <div class="option">
                        <input type="submit" value="Save Form" name="saveForm" class="btn btn-secondary primary" formaction="../PHP/handleForm.php"/>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <!-- foot of the website -->
    <?php include('../repeated_section/mobile-header.php')?>
    <?php include '../repeated_section/footer.html' ?>

    <script src="../JS/new-js/theme.js"></script>
    <script src="../JS/new-js/mobile-menu.js"></script>
    <script src="../JS/new-js/others.js"></script>
    <script src="../JS/category_type.js"></script>
</body>
</html>