<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../CSS/forgot_reset.css">
</head>
<body>
<main>
        <div class="details">
            <h2>Forgot Your Password?</h2>
            <h5 id="msg">Don't worry we got you.</h5>
            <span>Enter the email you want to reset the password</span>
            <form action="../PHP/passwordResetLink.php" method="post">
                <input type="email" name="email" id="Email" placeholder="Enter the email"/><br><br>
                <input type="submit" value="Send reset link" name="resetLink">
            </form>
            <div class="account">Already have an account? <a href="../index.php#loginForm">Log in</a></div>
        </div>
        <div class="illustration"></div>
        
    </main>
</body>
</html>