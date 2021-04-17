<?php

$uId = $_GET['uId'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change your Password</title>
    <link rel="stylesheet" href="../CSS/forgot_reset.css">
</head>
<body>
    <main>
    <div class="details">
            <h2>Reset Password</h2>
            <h5 id="msg">Please choose your new password</h5>
            <form action="../PHP/changePass.php" method="post">
                <input type="hidden" name="uId" value="<?=$uId?>"/>
                <!-- <label for="Pass">New password:</label><br><br> -->
                <input type="password" name="pass" id="Pass" placeholder="Enter new password"/><br><br>
                <!-- <label for="Repass">Confirm new password:</label><br><br> -->
                <input type="password" name="rePass" id="Repass" placeholder="Confirm new password"/><br><br>
                <input type="submit" value="Change Password" name="changePass"/>
            </form>
            <div class="account">Already have an account? <a href="Landing.php#loginForm">Log in</a></div>
        </div>
        <div class="illustration"></div>
        
    </main>
</body>
</html>