<?php

    if(isset($_GET['error'])){
        $error = $_GET['error'];
        $title = "Error";
        
            if($error == 'IllegalWay'){
                $icon = "<i class='far fa-angry fa-2x'></i>";
                $mssg = "Please ! Enter through proper way.";                
            }else if($error == 'NotInserted'){
                $icon = "<i class='far fa-grin-beam-sweat fa-2x'></i>";
                $mssg = "Some error occured. Please retry.";
            }else if($error == 'NotUser'){
                $icon = "<i class='fas fa-frown fa-2x'></i>";
                $mssg = "No such user found.";
            }else if($error == 'SendMailError'){
                $icon = "<i class='far fa-sad-cry fa-2x'></i>";
                $mssg = "Some technical issue detected. Please report.";
            }else if($error == 'WrongLink'){
                $icon = "<i class='far fa-dizzy fa-2x'></i>";
                $mssg = "The link must have been expired.";
            }else if($error == 'NotActivationCode'){
                $icon = "<i class='far fa-meh fa-2x'></i>";
                $mssg = "No such activation code found.";
            }
    }

    if(isset($_GET['inputError'])){
        $inputError = $_GET['inputError'];
    }

    if(isset($_GET['mssg'])){
        $successMssg = $_GET['mssg'];
        $title = "Hurray!";

        if($successMssg == 'CheckEmail'){
            $icon = "<i class='far fa-grin-beam fa-2x'></i>";
            $mssg = "Please check your email for verification";
        }
    }

    if(isset($_GET['infoBack'])){
        $infoBackLength = $_GET['infoBack'];
        $citizenNo = '';
        $name = $_GET['nameB'];
        $vReg = '';
        $engineCC = $_GET['engCCB'];
        $vType = $_GET['vTypeB'];
        $vCategory = $_GET['vCatB'];
        $email = '';
        $phone = '';
        $pp = $_GET['pp'];

            if($infoBackLength == "noPhone"){
                $email = $_GET['emailB'];
                $citizenNo = $_GET['citizenB'];
                $vReg = $_GET['vRegB'];
            }else if($infoBackLength == "noEmail"){
                $phone = $_GET['phoneB'];
                $citizenNo = $_GET['citizenB'];
                $vReg = $_GET['vRegB'];
            }else if($infoBackLength == "noCitizen"){
                $email = $_GET['emailB'];
                $phone = $_GET['phoneB'];
                $vReg = $_GET['vRegB'];
            }else if($infoBackLength == "noVreg"){
                $email = $_GET['emailB'];
                $phone = $_GET['phoneB'];
                $citizenNo = $_GET['citizenB'];
            }else if($infoBackLength == "full"){
                $email = $_GET['emailB'];
                $citizenNo = $_GET['citizenB'];
                $vReg = $_GET['vRegB'];
                $phone = $_GET['phoneB'];
            }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="stylesheet" href="./CSS/error.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <style>
        <?php
            if(isset($_GET['error'])){
                echo ".error-popup{
                    background-color:rgba(226,154,154,0.116);
                    color:rgb(185,14,14);
                    animation: animateFromTop 1s ease-in-out;
                    top: 50px;
                    left: 50%;
                    transform: translateX(-50%);
                }";
            }else if(isset($_GET['mssg'])){
                echo ".error-popup{
                    background-color:#DFF2BF;
                    color:#4F8A10;
                    animation: animateFromBottom 1s ease-in-out;
                    bottom: 20px;
                    right: 30%;
                    transform: translateX(30%);
                }";
            }

        ?>

        <?php
            if(!isset($_GET['error']) && !isset($_GET['mssg'])){
                echo ".error-popup{
                    display:none;
                }";
            }

        ?>

        <?php
            if($inputError == 'AlreadyUserEmail'){
                echo "input[type='email']{
                        border:1px solid red;
                }";
            }else if($inputError == 'PasswordNotSame'){
                echo "input[type='password']{
                        border:1px solid red;
                }";
            }else if($inputError == 'AlreadyUserPhone'){
                echo "input[type='number']{
                        border:1px solid red;
                }";
            }
        ?>
    </style>

    <script defer src="./JS/category_type.js"></script>
</head>
<body>
    <?php include './repeated_section/error.php'; ?>

    <main class="col-12">
        <form action="./PHP/handleUser.php" method="post">
            <h3>SIGN UP</h3>
            <table>
                <tr>
                    <td>
                        <input type="text" required placeholder="Full name" name="username" <?php if(isset($_GET['infoBack'])){echo "value='$name'";} ?>>
                    </td>
                    <td>
                        <input type="text" required placeholder="Phone number" name="phoneNumber" <?php if(isset($_GET['infoBack'])){echo "value='$phone'";} ?>>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="email" required placeholder="Email" name="email" <?php if(isset($_GET['infoBack'])){echo "value='$email'";} ?>>
                    </td>
                    <td>
                        <input type="text" required placeholder="Citizenship Number" name="citizenshipNumber" <?php if(isset($_GET['infoBack'])){echo "value='$citizenNo'";} ?>>
                    </td>
                </tr>
                <tr>
                    <td>
                        <select name="vType" id="type">
                            <option value="none">--Vehicle Type--</option>
                            <option value="two wheeler" <?php if(isset($_GET['infoBack'])){if($vType == "two wheeler"){echo "selected";}} ?>>Two Wheeler</option>
                            <option value="four wheeler" <?php if(isset($_GET['infoBack'])){if($vType == "four wheeler"){echo "selected";}} ?>>Four Wheeler</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" required placeholder="Vehicle Registration Number" name="vReg" <?php if(isset($_GET['infoBack'])){echo "value='$vReg'";} ?>> 
                    </td>
                </tr>
                <tr>
                    <td>
                        <select name="vCategory" id="category">
                            <?php
                                if(isset($_GET['infoBack'])){
                                    echo "<option value='$vCategory'>$vCategory</option>";
                                }
                            ?>
                            <option value="none">--Vehicle Category--</option>
                        </select>
                    </td>
                    <td>
                        <select name="engineCC" id="engCC">
                            <?php
                                if(isset($_GET['infoBack'])){
                                    echo "<option value='$engineCC'>$engineCC</option>";
                                }
                            ?>
                            <option value="none">--Engine CC--</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="radio" name="public_or_private" value="private" id="privateP" checked><label for="privateP">Private</label>
                        <input type="radio" name="public_or_private" value="public" id="publicP" <?php if(isset($_GET['infoBack'])){if($pp == 'public'){echo "checked";}} ?>><label for="publicP">Public</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="password" required placeholder="Password" name="password" id="pass">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="password" required placeholder="Confirm Password" name="repassword" id="rePass">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="Register" name="signup">
                    </td>
                </tr>
            </table>
            <button>
                <a href="Landing.php#loginForm">Log in</a>
            </button>
        </form>
    </main>

    <script>
        function closeErrorPopUp(){
            document.getElementsByClassName('error-popup')[0].style.display = 'none';
        }

        var input = document.getElementsByClassName('form-input');

        window.addEventListener('click', function(){
            for(var i = 0; i < input.length;i++){
                input[i].style.borderColor = 'rgb(211,211,211)';
            }
        });
    </script>
</body>
</html>