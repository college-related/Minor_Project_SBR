<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
</head>
<body>
    <main>
        <form action="../PHP/passwordResetLink.php" method="post">
            <label for="Email">Type your Email:</label><br><br>
            <input type="email" name="email" id="Email"/><br><br>
            <input type="submit" value="Send reset link" name="resetLink">
        </form>
    </main>
</body>
</html>