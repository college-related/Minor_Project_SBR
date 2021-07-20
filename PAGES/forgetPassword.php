<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../CSS/new-css/color.css">
    <link rel="stylesheet" href="../CSS/new-css/style.css">
    <link rel="stylesheet" href="../CSS/forgot_reset.css">
</head>
<body>
    <main  class="container form" >
        <div class="flex main-div">
            <div class="detail">
                    <h2 class="form-title web-title">Forgot Your Password?</h2>
                    <span >We got you.<br>Enter the email you want to reset the password</span>
                    <div class="form-body">
                        <form action="../PHP/passwordResetLink.php" method="post" >
                            <input type="email" name="email" id="Email" placeholder="Your Email" class="form-field form-group"/><br><br>
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
    <script src="../JS/new-js/mobile-menu.js"></script>
    <script src="../JS/new-js/theme.js"></script>
</body>
</html>