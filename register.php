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
        $address = $_GET['addressB'];
        $citizenNo = '';
        $name = $_GET['nameB'];
        $vReg = '';
        $engineCC = $_GET['engCCB'];
        $vType = $_GET['vTypeB'];
        $vCategory = $_GET['vCatB'];
        $email = '';
        $phone = '';

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
                    <th><label for="name">Full Name:</label></th>
                    <td><input type="text" id="name" name="Uname" required <?php if(isset($_GET['infoBack'])){echo "value='$name'";}?>/></td>
                    <th><label for="phone">Phone number:</label></th>
                    <td><input type="number" id="phone" name="Phn" required <?php if(isset($_GET['infoBack'])){echo "value='$phone'";}?>/></td>
                </tr>
                <tr>
                    <th><label for="email">Email:</label></th>
                    <td colspan="3"><input type="email" name="Email" id="email" required <?php if(isset($_GET['infoBack'])){echo "value='$email'";}?>/></td>
                </tr>
                <tr>
                    <th><label for="citizen">Citizenship no.:</label></th>
                    <td><input type="text" id="citizen" name="citizenshipNo" required <?php if(isset($_GET['infoBack'])){echo "value='$citizenNo'";}?>/></td>
                    <th><label for="address">Address:</label></th>
                    <td><input type="text" id="address" name="address" required <?php if(isset($_GET['infoBack'])){echo "value='$address'";}?>/></td>
                </tr>
                <tr>
                    <th><label for="type">Vehicle type:</label></th>
                    <td>
                        <select name="vType" id="type" required>
                            <option value="none"></option>
                            <option value="two Wheeler" <?php if(isset($_GET['infoBack'])){if($vType == "two Wheeler"){echo "selected";}}?>>Two Wheeler</option>
                            <option value="four Wheeler" <?php if(isset($_GET['infoBack'])){if($vType == "four Wheeler"){echo "selected";}}?>>Four Wheeler</option>
                        </select>
                    </td>
                    <th><label for="category">Vehicle Category:</label></th>
                    <td>
                        <select name="vCategory" id="category" required>
                            <?php
                                if(isset($_GET['infoBack'])){
                                    echo "<option value='$vCategory'>$vCategory</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="engCC">Engine CC:</label></th>
                    <td>
                        <select name="engineCC" id="engCC" required>
                                <?php
                                    if(isset($_GET['infoBack'])){
                                        echo "<option value='$engineCC'>$engineCC</option>";
                                    }
                                ?>
                        </select>
                    </td>
                    <th><label for="Vreg">Vehicle Registration:</label></th>
                    <td><input type="text" id="Vreg" name="vReg" required <?php if(isset($_GET['infoBack'])){echo "value='$vReg'";}?>/></td>
                </tr>
                <tr>
                    <th><label for="pass">Password:</label></th>
                    <td><input type="password" id="pass" name="Password" required/></td>
                    <th><label for="rePass">Confirm Password:</label></th>
                    <td><input type="password" id="rePass" name="Repass" required/></td>
                </tr>
                <tr>
                    <td colspan="4">
                        <input type="submit" value="Sign Up" name="signup"/>
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