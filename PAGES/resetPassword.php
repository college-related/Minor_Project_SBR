<?php

$uId = $_GET['uId'];

if(isset($_GET['error'])){
    $error = $_GET['error'];

    if($error == 'updateError'){
        $icon = "<i class='far fa-tired fa-2x'></i>";
        $title = "Please retry";
        $mssg = "Some error occured while changing password.";
    }else if($error == 'IllegalWay'){
        $icon = "<i class='far fa-angry fa-2x'></i>";
        $title = "Illegal Way";
        $mssg = "Please enter through Legal way.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Your Password</title>
    <link rel="stylesheet" href="../CSS/new-css/style.css">
    <link rel="stylesheet" href="../CSS/new-css/color.css">
    <link rel="stylesheet" href="../CSS/forgot_reset.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <style>
        <?php if(isset($_GET['error']) && $_GET['error'] == 'NotSamePass') {?>
            input[type="password"] {
                border: 1px solid #df4759;
            }
        <?php } ?>
    </style>
</head>
<body>
    <?php 
        if(isset($_GET['error']) && $_GET['error'] == 'updateError') { 
            include('../repeated_section/error.php');
        }
    ?>

    <main class="container form" >
        <div class="flex main-div">
            <div class=" detail">
                <h2 class="form-title web-title">Reset Password</h2>
                <div class="form-body">
                    <form action="../PHP/changePass.php" method="post">
                        <input type="hidden" name="uId" value="<?=$uId?>"/>
                        <!-- <label for="Pass">New password:</label><br><br> -->
                        <input type="password" name="pass" id="Pass" placeholder="New password" class="form-field form-group" required/>
                        <?php if(isset($_GET['error']) && $_GET['error'] == 'NotSamePass') {echo "<span class='text-danger'><i class='fas fa-exclamation-circle'></i> New Password not matched</span>";}?><br><br>
                        <!-- <label for="Repass">Confirm new password:</label><br><br> -->
                        <input type="password" name="rePass" id="Repass" placeholder="Confirm New Password" class="form-field form-group" required/><br><br>
                        <input type="submit" value="Reset Password" name="changePass" class="btn btn-accent btn-rounded form-group"/>
                    </form>
                </div>
                <div class="form-footer">
                    <span>Got Password? </span>
                    <a href="../index.php#form-wrapper" class="link-primary">Log in</a>
                </div>
            </div>
            <div class=" reset-password-image side-div">
                <img src="../ASSETS/IMAGES/undraw/reset-password.png" alt="reset-password" class="feature-img">    
            </div> 
            <h2 class="form-title mobile-title">Reset Password</h2>
        </div> 

        <script>
        function closeErrorPopUp(){
                document.getElementsByClassName('error-popup')[0].style.display = 'none';
            }
        </script>
        <script src="../JS/new-js/theme.js"></script>
    </main>
</body>
</html>