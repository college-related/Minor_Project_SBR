<?php

require "./includes/connection.php";

include('./includes/table_columns_name.php');

$email = $_GET['Email'];
$username = $_GET['Uname'];
$phonenumber = $_GET['Phone'];
$citizenshipNo = $_GET['CitizenNo'];
$vehicleType = $_GET['Vtype'];
$vehicleCategory = $_GET['Vcat'];
$vehicleReg = $_GET['Vreg'];
$engineCC = $_GET['EngCC'];
$pp = $_GET['pp'];

$encrypted_email = $_GET['email'];

$sql = "SELECT $activation_column FROM users WHERE $email_column = '$encrypted_email'";
$query = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($query);
$activeCode = $row[$activation_column];

if(mysqli_num_rows($query)){
    require './PHPMailer/PHPMailerAutoload.php';

    $url = "http://localhost/Minor_Project_SBR/PHP/verifyUser.php?activation_code=$activeCode";

    $adminEmail = 'swiftbluebook10@gmail.com';

    $mssg = "
    <h2>Hi, $username </h2>
    <p>Thank you for registeration</p>
    <p>
        Click this link to verify and log in into your account
        $url
    </p>
    ";

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = $adminEmail;
    $mail->Password = 'SBR12345rbs';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom($adminEmail, 'Swift Bluebook');

    $mail->addAddress($email, $username);

    $mail->Subject = 'Email Verification';

    $mail->isHTML(true);

    $mail->SMTPDebug = 2;

    $mail->Body = $mssg;

    if($mail->send()){
        // print_r($mail->ErrorInfo);
        // die();
        header("location: ../register.php?mssg=CheckEmail");
    }else{
        header("location: ../register.php?error=SendMailError&infoBack=full&nameB=$username&phoneB=$phonenumber&emailB=$email&addressB=$address&citizenB=$citizenshipNo&vRegB=$vehicleReg&engCCB=$engineCC&vTypeB=$vehicleType&vCatB=$vehicleCategory&pp=$pp");
    }
}else{
    header("location: ../register.php?error=NotUser");
}

?>