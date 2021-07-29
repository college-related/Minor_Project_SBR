<?php
    session_start();

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

    include('./repeated_section/language.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <style>
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
            }else if($inputError == 'AlreadyVReg'){
                echo "input[name='vReg']{
                    border:1px solid red;
                }";
            }else if($inputError == 'AlreadyCitizen'){
                echo "input[name='citizenshipNumber']{
                    border:1px solid red;
                }";
            }
        ?>
    </style>

    <script defer src="./JS/category_type.js"></script>
    <link rel="stylesheet" href="./CSS/new-css/style.css">
    <link rel="stylesheet" href="./CSS/new-css/register_page.css">
    <link rel="stylesheet" href="./CSS/new-css/loader.css">
    
</head>
<body>
    <?php if(isset($_GET['error'])){include './repeated_section/error.php';} ?>

    <div class="loader-wrapper"></div>
    <div class="loader"></div>

    <main>
        <div class="container flex">
            <div class="register">
                <form action="./PHP/handleUser.php" method="post" onsubmit="getLoader()">
                    <h1 class="web-title"><?=$lang['register-page']['title']?></h1>
                    <div>
                        <div class="row-2">
                            <div>
                                <input class="form-field" type="text" required placeholder="<?=$lang['register-page']['name-placeholder']?>" name="username" required <?php if(isset($_GET['infoBack'])){echo "value='$name'";} ?>>
                            </div>
                            <div>
                                <input class="form-field" type="number" required placeholder="<?=$lang['register-page']['phone-placeholder']?>" name="phoneNumber" required <?php if(isset($_GET['infoBack'])){echo "value='$phone'";} ?>><br>
                                <?php if(isset($_GET['inputError']) && $inputError == 'AlreadyUserPhone'){ echo "<span class='text-danger'><i class='fas fa-exclamation-circle'></i> This phone number already exists </span>"; } ?>
                            </div>
                        </div>
                        <div class="row-2">
                            <div>
                                    <input class="form-field" type="email" required placeholder="<?=$lang['register-page']['email-placeholder']?>" name="email" required <?php if(isset($_GET['infoBack'])){echo "value='$email'";} ?>> <br>
                                    <?php if(isset($_GET['inputError']) && $inputError == 'AlreadyUserEmail'){ echo "<span class='text-danger'><i class='fas fa-exclamation-circle'></i> This Email already exists</span>"; } ?>
                                </div>
                                <div>
                                    <input class="form-field" type="text" required placeholder="<?=$lang['register-page']['citizen-placeholder']?>" name="citizenshipNumber" required <?php if(isset($_GET['infoBack'])){echo "value='$citizenNo'";} ?>><br>
                                    <?php if(isset($_GET['inputError']) && $inputError == 'AlreadyCitizen'){ echo "<span class='text-danger'><i class='fas fa-exclamation-circle'></i> This citizenship number already exists</span>"; } ?>
                                </div>
                        </div>
                        <div class="row-2">
                            
                            <div>
                                <select class="form-field" name="vType" id="type" required>
                                    <option value="none"><?=$lang['register-page']['vType-placeholder']?></option>
                                    <option value="two wheeler" <?php if(isset($_GET['infoBack'])){if($vType == "two wheeler"){echo "selected";}} ?>>Two Wheeler</option>
                                    <option value="four wheeler" <?php if(isset($_GET['infoBack'])){if($vType == "four wheeler"){echo "selected";}} ?>>Four Wheeler</option>
                                </select>
                            </div>
                            <div>
                                <select class="form-field" name="vCategory" id="category" required>
                                    <?php
                                        if(isset($_GET['infoBack'])){
                                            echo "<option value='$vCategory'>$vCategory</option>";
                                        }
                                    ?>
                                    <option value="none"><?=$lang['register-page']['vCat-placeholder']?></option>
                                </select>
                            </div>

                        </div>
                        <div class="row-2">
                                <div class="row-2">
                                    <select class="form-field" name="engineCC" id="engCC" required>
                                        <?php
                                            if(isset($_GET['infoBack'])){
                                                echo "<option value='$engineCC'>$engineCC</option>";
                                            }
                                        ?>
                                        <option value="none"><?=$lang['register-page']['eng-placeholder']?></option>
                                    </select>
                                    <div class="row-2 public-private-wrapper">
                                        <input class="" type="radio" name="public_or_private" value="private" id="privateP" required checked><label class="text-center private-public" for="privateP"><?=$lang['register-page']['private-radio']?></label>
                                        <input class="" type="radio" name="public_or_private" value="public" id="publicP" <?php if(isset($_GET['infoBack'])){if($pp == 'public'){echo "checked";}} ?> ><label class=" text-center private-public" for="publicP"><?=$lang['register-page']['public-radio']?></label>   
                                    </div>
                                </div>
                            <div>
                                <input class="form-field" type="text" required placeholder="<?=$lang['register-page']['vReg-placeholder']?>" name="vReg" required <?php if(isset($_GET['infoBack'])){echo "value='$vReg'";} ?>><br> 
                                <?php if(isset($_GET['inputError']) && $inputError == 'AlreadyVReg'){ echo "<span class='text-danger'><i class='fas fa-exclamation-circle'></i> It is already registered</span>"; } ?>
                            </div>
                        </div>
                        <div class="row-2">
                            <div>
                                <input class="form-field" type="password" required placeholder="<?=$lang['register-page']['password-placeholder']?>" name="password" id="pass" required><br>
                                <?php if(isset($_GET['inputError']) && $inputError == 'PasswordNotSame'){ echo "<span class='text-danger'><i class='fas fa-exclamation-circle'></i> Password should match</span>"; } ?>
                            </div>
                            <div>
                                <input class="form-field" type="password" required placeholder="<?=$lang['register-page']['confirmPass-placeholder']?>" name="repassword" id="rePass" required>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <input class="btn btn-accent" type="submit" value="<?=$lang['register-page']['title']?>" name="signup">
                    </div>
                </form>
                <div class="text-center links">
                    <h5><?=$lang['register-page']['already-text']?>  <a href="index.php#form-wrapper" class="link-primary"><?=$lang['register-page']['already-link']?></a></h5>
                    <h5><a href="./PAGES/forgetPassword.php" class="link-underline"><?=$lang['register-page']['forgot-text']?></a></h5>
                </div>
            </div>
            <div class="img-background">
            <div class="image-holder">
                <img src="./ASSETS/IMAGES/undraw/welcome.png" alt="welcome image">
            </div>
            </div>
            <h1 class="mobile-title"><?=$lang['register-page']['title']?></h1>
        </div>
    </main>
    
    <script>
        function closeErrorPopUp(){
            document.getElementsByClassName('error-popup')[0].style.display = 'none';
        }

        function getLoader(){
            document.querySelector('.loader-wrapper').style.display = "block"
            document.querySelector('.loader').style.display = "block"
        }

        var input = document.getElementsByClassName('form-input');

        window.addEventListener('click', function(){
            for(var i = 0; i < input.length;i++){
                input[i].style.borderColor = 'rgb(211,211,211)';
            }
        });
    </script>
    <script src="./JS/new-js/theme.js"></script>
</body>
</html>