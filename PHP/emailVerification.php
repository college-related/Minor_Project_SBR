<?php

require 'connection.php';

session_start();

$email = $_SESSION['Email'];
$user = $_SESSION['Uname'];

$sql = "SELECT * FROM users WHERE EMAIL = $email";
$query = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($query);
$activeCode = $row['ACTIVATE_CODE'];

if(mysqli_num_rows($connect)){
    require 'PHPMailer/PHPMailerAutoload.php';

    $url = "https://swiftbluebookrenew.com/PHP/verifyUser.php?activation_code=$activeCode";

    $mssg = "
    <h2>Hi, $user </h2>
    <p>Thank you for registeration</p>
    <p>
        Click this link to verify and log in into your account
        $url
    </p>
    "

    $mail = new PHPMailer;

    $mail->setFrom('swiftbluebook10@gmail.com', 'Swift Bluebook');

    $mail->addAddress($email, $user);

    $mail->Subject = 'Email Verification';

    $mail->IsHTML(true);

    $mail->Body = $mssg;

    if(!$mail->send()){
        header("location: ../Landing.php#signupForm?mssg=sendMailError");
    }else{
        header("location: ../Landing.php#signupForm?mssg=CheckEmail");
    }
}else{
    header("location: ../Landing.php#signupForm?mssg=SomeError");
}

?>