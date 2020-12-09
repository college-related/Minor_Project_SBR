<?php

    session_start();
    $uId = $_SESSION['uId'];
    $name = " ";
    $citizen = " ";
    $address = " ";
    $phn = " ";
    $vehicleType = " ";
    $vehicleCategory = " ";
    $vehicleReg = " ";
    $engineCC = " ";
    $name1 = " ";
    $citizen1 = " ";
    $address1 = " ";
    $phn1 = " ";
    $vehicleReg1 = " ";

    function decryptData($data, $key){
        $encryption_key = base64_decode($key);
        list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2),2,null);
        $decryptedData = openssl_decrypt($encrypted_data, "aes-256-cbc", $encryption_key, 0, $iv);

        return $decryptedData;
    }

    if(isset($_GET['autoFill'])){
        require('../PHP/connection.php');

        $info = mysqli_fetch_all(
            mysqli_query(
                $connect,
                "SELECT users.ADDRESS, users.CITIZEN, users.NAME, users.PHN, vehicle_data.* FROM users JOIN vehicle_data ON users.uId=vehicle_data.uId WHERE users.uId='$uId' && vehicle_data.uId='$uId'"
            ),
            MYSQLI_ASSOC
        );
    
        $str = "/6G6F;WvK7;s{au/6G6F;WvK7;s{au";
        $key = md5($str);

        $name = decryptData($info[0]["NAME"], $key);
        $citizen = decryptData($info[0]["CITIZEN"], $key);
        $address = decryptData($info[0]["ADDRESS"], $key);
        $phn = decryptData($info[0]["PHN"], $key);
        $vehicleType = $info[0]["VEHICLE_TYPE"];
        $vehicleCategory = $info[0]["VEHICLE_CATEGORY"];
        $vehicleReg = decryptData($info[0]["VEHICLE_REG"], $key);
        $engineCC = $info[0]["ENGINE_CC"];
        $name1 = $name;
        $citizen1 = $citizen;
        $address1 = $address;
        $phn1 = $phn;
        $vehicleReg1 = $vehicleReg;
    }

    if(isset($_GET['reset'])){
        require('../PHP/connection.php');

        $info = mysqli_fetch_all(
            mysqli_query(
                $connect,
                "SELECT users.ADDRESS, users.CITIZEN, users.NAME, users.PHN, vehicle_data.VEHICLE_REG FROM users JOIN vehicle_data ON users.uId=vehicle_data.uId WHERE users.uId='$uId' && vehicle_data.uId='$uId'"
            ),
            MYSQLI_ASSOC
        );
        
        $str = "/6G6F;WvK7;s{au/6G6F;WvK7;s{au";
        $key = md5($str);

        $name1 = decryptData($info[0]["NAME"], $key);
        $citizen1 = decryptData($info[0]["CITIZEN"], $key);
        $address1 = decryptData($info[0]["ADDRESS"], $key);
        $phn1 = decryptData($info[0]["PHN"], $key);
        $vehicleReg1 = decryptData($info[0]["VEHICLE_REG"], $key);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/form.css">

    <style>

        /* styling for the insurance section where the radio buttons are present */
        .insurance-slip {
            width: fit-content;
        }

        /* giving top margin for more space between form and banner section */
        .form-main {
            margin-top: 40px;
        }

        <?php
            if(isset($_GET['reset'])){
                echo 
                    "
                    .others-info{
                        display: block;
                    }
                    ";
            }
        ?>

        .btns form {
            background-color: transparent;
            padding: 0;
        }

    </style>

    <script defer src="../JS/category_type.js"></script>
    <script defer src="../js/others.js"></script>

</head>
<body>
    <header class="col-12">

        <!-- logo and website name -->
        <span id="logo">SWIFT BLUEBOOK RENEW</span>

        <!-- navigation bar for desktop view -->
        <nav>
            <ul>
                <li><a href="./information.php?isLogged=true">Infos</a></li>
                <li><a href="#" class="active-nav-link">Form</a></li>
                <li><a href="./profile.php?Logged">Profile</a></li>
                <li><a href="../php/logout.php">LogOut</a></li>
            </ul>
        </nav>
       
    </header>

    <main class="form-main col-12">
        <!-- checkbox to check if the form is for others -->
        <div class="btns">
            <div>
                <input type="checkbox" id="check" onclick="reveal()" <?php if(isset($_GET['reset'])){echo "checked";} ?>>
                For-Others
            </div>
            <form action="" method="get">
                <input type="submit" value="Auto-Fill" name="autoFill" id="autofill" <?php if(isset($_GET['reset'])){echo "disabled";} ?>/>
            </form>
            <form action="" method="get">
                <input type="submit" value="Auto-Fill For others" name="reset" id="resetBtn" disabled/>
            </form>
        </div>
        <form action="../PHP/handleForm.php" method="POST">
            <!-- hidden div for others -->
            <div class="others-info">
                <h3>Information of the person you are filling the form of:</h3>
            </div>
            <!-- personal details section -->
            <fieldset>
                <legend>Personal details:</legend>
                <table>
                    <tr>
                        <td><label for="name">Name:</label></td>
                        <td><input type="text" name="Name" id="name" value='<?=$name?>' required/></td>
                    </tr>
                    <tr>
                        <td><label for="phn">Phone Number:</label></td>
                        <td><input type="number" name="Phn" id="phn" value='<?=$phn?>' required/></td>
                    </tr>
                    <tr>
                        <td><label for="address">Address:</label></td>
                        <td><input type="text" name="Address" id="address" value='<?=$address?>' required/></td>
                    </tr>
                    <tr>
                        <td><label for="citizen">Citizenship number:</label></td>
                        <td><input type="text" name="Citizen" id="citizen" value='<?=$citizen?>' required/></td>
                    </tr>
                </table>
            </fieldset>
            <!-- Vechile details section -->
            <fieldset>
                <legend>Vechile details:</legend>
                <table>
                    <tr>
                        <td><label for="type">Type:</label></td>
                        <td>
                            <select name="Vtype" id="type" required>
                                <option value="none"></option>
                                <option value="two Wheeler" <?php if(isset($_GET['autoFill'])){if($vehicleType == "two wheeler"){echo "selected";}} ?>>Two wheeler</option>
                                <option value="four Wheeler" <?php if(isset($_GET['autoFill'])){if($vehicleType == "four wheeler"){echo "selected";}} ?>>Four wheeler</option>
                            </select>
                        </td>
                        <td><label for="category">Category:</label></td>
                        <td>
                            <select name="Vcategory" id="category" required>
                                <?php
                                    if(isset($_GET['autoFill'])){
                                        echo "<option value='$vehicleCategory'>$vehicleCategory</option>";
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><label for="engine">Engine CC:</label></td>
                        <td colspan="2">
                            <select name="EngineCC" id="engCC" required>
                                    <?php
                                        if(isset($_GET['autoFill'])){
                                            echo "<option value='$engineCC'>$engineCC</option>";
                                        }
                                    ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><label for="vehicleReg">Vehicle Registration no:</label></td>
                        <td colspan="2"><input type="text" name="VehicleReg" id="vehicleReg" placeholder="GA 16 PA 4381" value='<?=$vehicleReg?>' required/></td>
                    </tr>
                </table>
            </fieldset>
            <!-- Bluebook / insurance section -->
            <fieldset>
                <legend>BLUEBOOK/Insurance:</legend>
                <table>
                    <tr>
                        <td><label for="renewDate">Last Renew Date:</label></td>
                        <td><input type="date" name="RenewDate" id="renewDate"/></td>
                    </tr>
                    <tr>
                        <td><label for="insuranceSlip">Insurance Slip:</label></td>
                        <td>
                            <input type="radio" name="insuranceSlip" value="yes" class="insurance-slip">YES
                            <input type="radio" name="insuranceSlip" value="no" class="insurance-slip">NO
                        </td>
                    </tr>
                </table>
            </fieldset>
            <!-- hidden section for others -->
            <!-- Here we fill the users data -->
            <div class="others-info">
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
                            <td><label for="address1">Address:</label></td>
                            <td><input type="text" name="Address1" id="address1" value="<?=$address1?>"/></td>
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
            </div>
            <!-- submit button section -->
            <fieldset>
                <legend>Submit:</legend>
                <table>
                    <tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" value="Save Form" name="saveForm" formaction="../PHP/handleForm.php"/>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </form>
    </main>

    <!-- foot of the website -->
    <?php include("../repeated_section/footer.html"); ?>

</body>
</html>