<?php

require 'connection.php';

$email = $_GET['Email'];
$username = $_GET['Uname'];
$phonenumber = $_GET['Phone'];
$address = $_GET['Address'];
$citizenshipNo = $_GET['CitizenNo'];
$vehicleType = $_GET['Vtype'];
$vehicleCategory = $_GET['Vcat'];
$vehicleReg = $_GET['Vreg'];
$engineCC = $_GET['EngCC'];

$encrypted_email = $_GET['email'];

$sql = "SELECT ACTIVATE_CODE FROM users WHERE EMAIL = '$encrypted_email'";
$query = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($query);
$activeCode = $row['ACTIVATE_CODE'];

if(mysqli_num_rows($query)){
    require 'PHPMailer/PHPMailerAutoload.php';

    $url = "https://localhost/college_project/Minor_Project_SBR/PHP/verifyUser.php?activation_code=$activeCode";

    $mssg = "
    <h2>Hi, $username </h2>
    <p>Thank you for registeration</p>
    <p>
        Click this link to verify and log in into your account
        $url
    </p>
    ";

    $mail = new PHPMailer;

    $mail->setFrom('swiftbluebook10@gmail.com', 'Swift Bluebook');

    $mail->addAddress($email, $username);

    $mail->Subject = 'Email Verification';

    $mail->IsHTML(true);

    $mail->Body = $mssg;

    if(!$mail->send()){
        header("location: ../register.php?error=SendMailError&infoBack=full&nameB=$username&phoneB=$phonenumber&emailB=$email&addressB=$address&citizenB=$citizenshipNo&vRegB=$vehicleReg&engCCB=$engineCC&vTypeB=$vehicleType&vCatB=$vehicleCategory");
    }else{
        header("location: ../register.php?mssg=CheckEmail");
    }
}else{
    header("location: ../register.php?error=NotUser");
}

?>