<?php

function encryptData($data, $key, $str){
    $encryption_key = base64_decode($key);
    $ivlength = substr(md5($str."users"),1, 16);
    $encryptedData = openssl_encrypt($data, "aes-256-cbc", $encryption_key, 0, $ivlength);
  
    return base64_encode($encryptedData.'::'.$ivlength);
}

require 'connection.php';

session_start();

$email = $_SESSION['Email'];
$username = $_SESSION['Uname'];
$phonenumber = $_SESSION['Phone'];
$address = $_SESSION['Address'];
$citizenshipNo = $_SESSION['CitizenNo'];
$vehicleType = $_SESSION['Vtype'];
$vehicleCategory = $_SESSION['Vcat'];
$vehicleReg = $_SESSION['Vreg'];
$engineCC = $_SESSION['EngCC'];

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