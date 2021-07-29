<?php
    if(isset($_GET['mssg'])){
        $icon = '<i class="fas fa-grin-beam fa-2x"></i>';
        $title = "Send reset link";
        $mssg = "Please check your email";
    }

    session_start();
    include('../repeated_section/language.php');
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
                    <h2 class="form-title web-title"><?=$lang['forgot-password-page']['title']?></h2>
                    <span ><?=$lang['forgot-password-page']['info-text']?><br><?=$lang['forgot-password-page']['info-text-two']?></span>
                    <div class="form-body">
                        <form action="../PHP/passwordResetLink.php" method="post" >
                            <input type="email" name="email" id="Email" placeholder="<?=$lang['forgot-password-page']['placeholder']?>" class="form-field form-group" required/>
                            <?php if(isset($_GET['error'])){echo "<span class='text-danger'><i class='fas fa-exclamation-circle'></i> No such email found</span>";} ?><br><br>
                            <input type="submit" value="<?=$lang['forgot-password-page']['btn-text']?>" name="resetLink" class="btn btn-accent  form-group">
                        </form>
                    </div>
                    <div class="form-footer">
                        <span><?=$lang['forgot-password-page']['already-text']?></span>
                        <a href="../index.php#form-wrapper" class="link-primary"><?=$lang['forgot-password-page']['already-link']?></a>
                    </div>
            </div>
            <div class="forgot-password-image">
                <img src="../ASSETS/IMAGES/undraw/forgot-password.png" alt="forgot-password" class="feature-img">
            </div>
            <h2 class="form-title mobile-title"><?=$lang['forgot-password-page']['title']?></h2>
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