<?php

require "./includes/connection.php";
require("./includes/table_columns_name.php");

$date = DATE("Y-m-d", strtotime('- 363 day'));

$sql = "SELECT $email_column, $username_column FROM users WHERE $createdAt_column = '$date'";
$query = mysqli_query($connect, $sql);

$emailArr = mysqli_fetch_all($query, MYSQLI_ASSOC);

if(!empty($emailArr)){

require 'PHPMailer/PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;
$mail->Username = $adminEmail;
$mail->Password = 'SBR12345rbs';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

//Set who the message is to be sent from
$mail->setFrom('swiftbluebook10@gmail.com', 'SwiftBluebook');
//Set who the message is to be sent to
foreach($emailArr as $data){
    $mail->addAddress($data[$email_column], $data[$username_column]);
}
//Set the subject line
$mail->Subject = 'Bluebook Renew Notification';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML(file_get_contents('notificationMessage.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
$mail->AltBody = 'BlueBook Renew in 3 days, Thank you!!';
//Attach an image file
// $mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
}

?>