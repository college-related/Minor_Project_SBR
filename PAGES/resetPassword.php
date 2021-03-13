<?php

$uId = $_GET['uId'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change your Password</title>
</head>
<body>
    <main>
        <form action="../PHP/changePass.php" method="post">
            <input type="hidden" name="uId" value="<?=$uId?>"/>
            <label for="Pass">New password:</label><br><br>
            <input type="password" name="pass" id="Pass"/><br><br>
            <label for="Repass">Confirm new password:</label><br><br>
            <input type="password" name="rePass" id="Repass"/><br><br>
            <input type="submit" value="Change Password" name="changePass"/>
        </form>
    </main>
</body>
</html>