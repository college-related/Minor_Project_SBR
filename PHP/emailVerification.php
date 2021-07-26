<?php
ob_start();
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

    // * creating message
    $mssg = "
    <h2>Hi, $username </h2>
    <p>Thank you for registeration</p>
    <p>
        Click this link to verify and log in into your account
        <br><br>
        <table width='100%' border='0' cellspacing='0' cellpadding='0'>
            <tr>
                <td>
                <table border='0' cellspacing='0' cellpadding='0'>
                    <tr>
                    <td>
                        <a href='$url' target='_blank' style='font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #000; text-decoration: none; border-radius: 3px; background-color: #89A6F3; border-top: 12px solid #89A6F3; border-bottom: 12px solid #89A6F3; border-right: 18px solid #89A6F3; border-left: 18px solid #89A6F3; display: inline-block;'>Verify Your Account</a>
                    </td>
                    </tr>
                </table>
                </td>
            </tr>
        </table>
    </p>
    ";

    // * creating a PHPMailer instance
    $mail = new PHPMailer(true);

    // * configuring the PHPMailer to SMTP for gmail
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = $adminEmail;
    $mail->Password = 'SBR12345rbs';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    if(file_exists("./includes/phpMailer_fix.php")){
        include("./includes/phpMailer_fix.php");
    }

    // * setting the email address and name of sender
    $mail->setFrom($adminEmail, 'Swift Bluebook');

    // * setting email address and name of reciver
    $mail->addAddress($email, $username);

    // * Setting subject of the email
    $mail->Subject = 'Email Verification';

    // * defining the body message contains HTML
    $mail->isHTML(true);

    // * For debugging
    $mail->SMTPDebug = 2;

    // * setting the body of the email
    $mail->Body = $mssg;

    // * sending the email and checking error
    if($mail->send()){
        header("location: ../PAGES/sendEmail.html");
    }else{
        header("location: ../register.php?error=SendMailError&infoBack=full&nameB=$username&phoneB=$phonenumber&emailB=$email&addressB=$address&citizenB=$citizenshipNo&vRegB=$vehicleReg&engCCB=$engineCC&vTypeB=$vehicleType&vCatB=$vehicleCategory&pp=$pp");
    }
}else{
    header("location: ../register.php?error=NotUser");
}

?>