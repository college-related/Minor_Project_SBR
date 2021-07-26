<?php
    if(isset($_GET['mssg'])){
        $icon = '<i class="fas fa-grin-beam fa-2x"></i>';
        $title = "Send reset link";
        $mssg = "Please check your email";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../CSS/new-css/style.css">
    <link rel="stylesheet" href="../CSS/new-css/forgot_reset.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <style>
        <?php if(isset($_GET['error'])) { ?>
            #Email {
                border: 1px solid #df4759;
            }
        <?php } ?>
    </style>
</head>
<body>
    <?php 
        if(isset($_GET['mssg'])){
            include('../repeated_section/success.php');
        }
    ?>

    <main  class="container form" >
        <div class="flex main-div">
            <div class="detail">
                    <h2 class="form-title web-title">Forgot Your Password?</h2>
                    <span >We got you.<br>Enter the email you want to reset the password</span>
                    <div class="form-body">
                        <form action="../PHP/passwordResetLink.php" method="post" >
                            <input type="email" name="email" id="Email" placeholder="Your Email" class="form-field form-group" required/>
                            <?php if(isset($_GET['error'])){echo "<span class='text-danger'><i class='fas fa-exclamation-circle'></i> No such email found</span>";} ?><br><br>
                            <input type="submit" value="Send Reset Link" name="resetLink" class="btn btn-accent  form-group">
                        </form>
                    </div>
                    <div class="form-footer">
                        <span>Got Password?</span>
                        <a href="../index.php#form-wrapper" class="link-primary">Log in</a>
                    </div>
            </div>
            <div class="forgot-password-image">
                <img src="../ASSETS/IMAGES/undraw/forgot-password.png" alt="forgot-password" class="feature-img">
            </div>
            <h2 class="form-title mobile-title">Forgot Your Password?</h2>
        </div>
    </main>

    <script>
        function closesuccessPopUp(){
            document.getElementsByClassName('success-popup')[0].style.display = 'none';
        }
    </script>
    <script src="../JS/new-js/theme.js"></script>
</body>
</html>