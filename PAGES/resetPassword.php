<?php

$uId = $_GET['uId'];

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
</head>
<body>
    <main class="container form" >
        <div class="flex main-div">
            <div class=" detail">
                <h2 class="form-title web-title">Reset Password</h2>
                <div class="form-body">
                    <form action="../PHP/changePass.php" method="post">
                        <input type="hidden" name="uId" value="<?=$uId?>"/>
                        <!-- <label for="Pass">New password:</label><br><br> -->
                        <input type="password" name="pass" id="Pass" placeholder="New password" class="form-field form-group"/><br><br>
                        <!-- <label for="Repass">Confirm new password:</label><br><br> -->
                        <input type="password" name="rePass" id="Repass" placeholder="Confirm New Password" class="form-field form-group"/><br><br>
                        <input type="submit" value="Reset Password" name="changePass" class="btn btn-accent btn-rounded form-group"/>
                    </form>
                </div>
                <div class="form-footer">
                    <span>Got Password? </span>
                    <a href="Landing.php#loginForm" class="link-primary">Log in</a>
                </div>
            </div>
            <div class=" reset-password-image side-div">
                <img src="../ASSETS/IMAGES/undraw/reset-password.png" alt="reset-password" class="feature-img">    
            </div> 
            <h2 class="form-title mobile-title">Reset Password</h2>
        </div> 
        <script src="../JS/new-js/mobile-menu.js"></script>
        <script src="../JS/new-js/theme.js"></script>
    </main>
</body>
</html>