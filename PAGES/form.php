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

    include("../PHP/includes/encryption.php");

    if(isset($_GET['autoFill'])){
        require "../PHP/includes/connection.php";
        include("../PHP/includes/table_columns_name.php");

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

    if(isset($_GET['reset'])){
        require "../PHP/includes/connection.php";
        include("../PHP/includes/table_columns_name.php");

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


    <script defer src="../JS/category_type.js"></script>
    <script defer src="../js/others.js"></script>

</head>
<body>
    <?php include('../repeated_section/header.php')?>
    <main>
        <div class="form container">
            <!-- checkbox to check if the form is for others -->
            <div class="btns">
                <div class="option justify-center">
                    <span id="check" onclick="reveal()" <?php if(isset($_GET['reset'])){echo "checked";} ?> >
                        Are you filling form for others? Check Here
                        <i class="far fa-check-circle"></i>
                    </span>
                
                    <form action="" method="get">
                        <input type="submit" value="Auto-Fill" class="btn secondary btn-rounded" name="autoFill" id="autofill" <?php if(isset($_GET['reset'])){echo "disabled";} ?>/>
                    </form>
                </div>
                <!-- <form action="" method="get">
                    <input type="submit" value="Auto-Fill For others" name="reset" id="resetBtn" disabled/>
                </form> -->
            </div>
            <form action="../PHP/handleForm.php" method="POST">
                <!-- hidden div for others -->
                <!-- <div class="others-info">
                    <h3>Information of the person you are filling the form of:</h3>
                </div> -->
                <!-- personal details section -->

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
                <h3 class="form-title">Vechile Information</h3>
                <hr class="hr"> 
                <div class="details">
                    <div class="row-2">
                        
                            <div class="flex form-flex">
                                <label for="type">Vehicle Type:</label>
                                <select name="Vtype" id="type" class="form-field" required>
                                    <option value="none"></option>
                                    <option value="two Wheeler" <?php if(isset($_GET['autoFill'])){if($vehicleType == "two wheeler"){echo "selected";}} ?>>Two wheeler</option>
                                    <option value="four Wheeler" <?php if(isset($_GET['autoFill'])){if($vehicleType == "four wheeler"){echo "selected";}} ?>>Four wheeler</option>
                                </select>
                            </div>
                            <div class="flex form-flex">
                                <label for="category">Vehicle Category:</label>
                                <select name="Vcategory" id="category" class="form-field" required>
                                    <?php
                                        if(isset($_GET['autoFill'])){
                                            echo "<option value='$vehicleCategory'>$vehicleCategory</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        
                        
                            <div class="flex form-flex">
                                <label for="engine">Engine CC:</label>
                                <select name="EngineCC" id="engCC" class="form-field" required>
                                        <?php
                                            if(isset($_GET['autoFill'])){
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
                            <input type="date" name="RenewDate" id="renewDate" class="form-field"/>
                        </div>
                        <div class="flex form-flex">
                            <label for="insuranceSlip"><h4>Have you paid insurance? :</h4></label>
                            <select class="form-field" name="insuranceSlip" required>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- hidden section for others -->
                <!-- Here we fill the users data -->
                <!-- <div class="others-info">
                    <h3>Your information:</h3>
                    <fieldset>
                        <legend>Personal data:</legend>
                        <table>
                            <tr>
                                <td><label for="name1">Name:</label></td>
                                <td><input type="text" name="Name1" id="name1" value="<?=$name1?>"/></td>
                            </tr>
                            <tr>
                                <td><label for="phn1">Phone Number:</label></td>
                                <td><input type="number" name="Phn1" id="phn1" value="<?=$phn1?>"/></td>
                            </tr>
                            <tr>
                                <td><label for="citizen1">Citizenship number:</label></td>
                                <td><input type="text" name="Citizen1" id="citizen1" value="<?=$citizen1?>"/></td>
                            </tr>
                        </table>
                    </fieldset>
                    <fieldset>
                        <legend>Vechile data:</legend>
                        <table>
                            <tr>
                                <td><label for="vehicleReg1">Vehicle Registration no:</label></td>
                                <td><input type="text" name="VehicleReg1" id="vehicleReg1" placeholder="GA 16 PA 4382" value="<?=$vehicleReg1?>"/></td>
                            </tr>
                        </table>
                    </fieldset>
                </div> -->
                <!-- submit button section -->
                <div class="row-2 details">
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

</body>
</html>