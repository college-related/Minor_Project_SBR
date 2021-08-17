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

    include('../repeated_section/language.php');
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

    <link rel="stylesheet" href="../JS/dist/mc-calendar.min.css" />
</head>
<body>
    <?php include('../repeated_section/header.php')?>
    <main>
        <div class="form container">
            <!-- checkbox to check if the form is for others -->
            <div class="btns">
                <div class="option justify-center">
                    <span>
                        <?=$lang['form-page']['top-text']?>
                        <span id="check" onclick="reveal()">
                        <?php if(isset($_GET['autoOtherFill']) || isset($_GET['fId'])) { ?>
                            <i class="fas fa-check-circle"></i>
                        <?php }else{ ?>
                            <i class="far fa-check-circle"></i>
                        <?php } ?>
                        </span>
                    </span>
                    <form action="" method="get" id="autoFill" <?php if(isset($_GET['autoOtherFill']) || isset($_GET['fId'])) {echo "style='display:none'"; }?>>
                        <input type="submit" value="<?=$lang['form-page']['btn-text-1']?>" class="btn secondary btn-rounded" name="autoFill"/>
                    </form>
                    <form action="" method="get" id="autoOtherFill" style="display: <?php if(isset($_GET['autoOtherFill']) || (isset($_GET['other']) && $_GET['other'] == 'yes')) {echo "block"; }else{echo "none";}?>;">
                        <input type="submit" value="<?=$lang['form-page']['btn-text-1']?>" class="btn secondary btn-rounded" name="autoOtherFill"/>
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
                        <h3 class="form-title"><?=$lang['form-page']['h1-text-4']?></h3>
                        <hr class="hr">
                        <div class="details">
                            <div class="row-2">
                                <div class="flex form-flex">
                                    <label for="name1"><?=$lang['form-page']['form-texts'][0]?>:</label>
                                    <input type="text" name="Name1" id="name1" class="form-field" value='<?=$name1?>' placeholder="<?=$lang['form-page']['form-texts'][2]?>" required />
                                </div>
                                <div class="flex form-flex">
                                    <label for="phn1"><?=$lang['form-page']['form-texts'][1]?>:</label>
                                    <input type="number" name="Phn1" id="phn1" value="<?=$phn1?>" class="form-field"  value='<?=$phn1?>' placeholder="<?=$lang['form-page']['form-texts'][3]?>" required/>
                                </div>
                            </div>
                            <div class="row-2">
                                <div class="flex form-flex col-2">
                                    <label  for="vehicleReg1"><?=$lang['form-page']['form-texts'][5]?>:</label>
                                    <input type="text" name="VehicleReg1" id="vehicleReg1"  class="form-field" value="<?=$vehicleReg1?>" placeholder="<?=$lang['form-page']['form-texts'][6]?>" required/>
                                </div>
                            </div>  
                        </div>
                    </div>
                    <h3 class="form-title"><?=$lang['form-page']['h1-text-1']?></h3>
                    <hr class="hr">
                    <div class="details">
                        <div class="row-2">
                            <div class="flex form-flex">
                                <label for="name"><?=$lang['form-page']['form-texts'][0]?>:</label>
                                <input type="text" name="Name" id="name" class="form-field" placeholder="<?=$lang['form-page']['form-texts'][0]?>" value='<?=$name?>' required/>
                            </div>
                            <div class="flex form-flex">
                                <label for="phn"><?=$lang['form-page']['form-texts'][1]?>:</label>
                                <input type="number" name="Phn" id="phn" class="form-field" placeholder="<?=$lang['form-page']['form-texts'][1]?>" value='<?=$phn?>' required/>
                            </div>
                        </div>
                        <div class="row-2">
                            <div class="flex form-flex col-2">
                                <label for="citizen"><?=$lang['form-page']['form-texts'][4]?>:</label>
                                <input type="text" name="Citizen" id="citizen" class="form-field" placeholder="<?=$lang['form-page']['form-texts'][4]?>"  value='<?=$citizen?>' required/>
                            </div>
                        </div>  
                    </div>
                    <!-- Vechile details section -->
                    <h3 class="form-title"><?=$lang['form-page']['h1-text-2']?></h3>
                    <hr class="hr"> 
                    <div class="details">
                        <div class="row-2">
                            <div class="flex form-flex">
                                <label for="type"><?=$lang['form-page']['form-texts'][7]?>:</label>
                                <select name="Vtype" id="type" class="form-field" required>
                                    <option value="none"></option>
                                    <option value="two Wheeler" <?php if($vehicleType != ""){if($vehicleType == "two wheeler"){echo "selected";}} ?>>Two wheeler</option>
                                    <option value="four Wheeler" <?php if($vehicleType != ""){if($vehicleType == "four wheeler"){echo "selected";}} ?>>Four wheeler</option>
                                </select>
                            </div>
                            <div class="flex form-flex">
                                <label for="category"><?=$lang['form-page']['form-texts'][8]?>:</label>
                                <select name="Vcategory" id="category" class="form-field" required>
                                    <?php
                                        if($vehicleCategory != ""){
                                            echo "<option value='$vehicleCategory'>$vehicleCategory</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="flex form-flex">
                                <label for="engine"><?=$lang['form-page']['form-texts'][9]?>:</label>
                                <select name="EngineCC" id="engCC" class="form-field" required>
                                        <?php
                                            if($engineCC != ""){
                                                echo "<option value='$engineCC'>$engineCC</option>";
                                            }
                                        ?>
                                </select>
                            </div>
                            <div class="flex form-flex">
                                <label for="publicOrPrivate"><?=$lang['form-page']['form-texts'][10]?>:</label>
                                <select class="form-field" name="pp" required>
                                    <option value="private" selected>
                                        <?=$lang['form-page']['form-texts'][11]?>
                                    </option>
                                    <option value="public" <?php if(isset($_GET['autoFill'])){if($pp == 'public'){echo "selected";}} ?> >
                                        <?=$lang['form-page']['form-texts'][12]?>
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="row-2">
                            <div class="col-2 flex form-flex">
                                <label for="vehicleReg"><?=$lang['form-page']['form-texts'][5]?>:</label>
                                <input type="text" name="VehicleReg" id="vehicleReg" class="form-field" placeholder="Ex: GA 16 PA 4381" value='<?=$vehicleReg?>' required/>
                            </div>
                        </div>
                    </div>
                    <!-- Bluebook / insurance section -->
                    <h3 class="form-title"><?=$lang['form-page']['h1-text-3']?></h3>
                    <hr class="hr">
                    <div class="details">
                        <div class="row-2">
                            <div class="flex form-flex">
                                <label for="renewDate"><?=$lang['form-page']['form-texts'][13]?>:</label>
                                <!-- <input type="date" name="RenewDate" id="renewDate" class="form-field" required <?php if(isset($lastRenew)){echo "value='$lastRenew'";} ?>/> -->
                                <input type="text" name="RenewDate" id="date-field" class="form-field" placeholder="Date" <?php if(isset($lastRenew)){echo "value='$lastRenew'";} ?>/>
                            </div>
                            <div class="flex form-flex">
                                <label for="insuranceSlip"><h4><?=$lang['form-page']['form-texts'][14]?>? :</h4></label>
                                <select class="form-field" name="insuranceSlip" required>
                                    <option value="">-Select an option-</option>
                                    <option value="yes" <?php if(isset($insurance) && $insurance == 'yes'){echo "selected";} ?>><?=$lang['form-page']['form-texts'][15]?></option>
                                    <option value="no" <?php if(isset($insurance) && $insurance == 'no'){echo "selected";} ?>><?=$lang['form-page']['form-texts'][16]?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" row-2 message-holder">
                    <div>
                        <h4 class="message"><?=$lang['form-page']['check-text']?></h4>
                        <h4><?=$lang['form-page']['thank-text']?></h4>
                    </div>   
                    <div class="option">
                        <input type="submit" value="<?=$lang['form-page']['btn-text-2']?>" name="saveForm" class="btn btn-secondary primary" formaction="../PHP/handleForm.php"/>
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
    <script src="../JS/dist/mc-calendar.min.js"></script>

    <script>
        const myDatePicker = MCDatepicker.create({ 
            el: '#date-field',
            dateFormat: 'YYYY-MM-DD',
            bodyType: 'inline',
            maxDate: new Date(),
        })
    </script>
</body>
</html>