<?php

require "./includes/connection.php";
require("./includes/table_columns_name.php");

$date = DATE("Y-m-d", strtotime('- 363 day'));

$sql = "SELECT $email_column, $username_column FROM users WHERE $createdAt_column = '$date'";
$query = mysqli_query($connect, $sql);

$emailArr = mysqli_fetch_all($query, MYSQLI_ASSOC);

// * continue if there are rows matching the date
if(!empty($emailArr)){

require 'PHPMailer/PHPMailerAutoload.php';

// * Create a new PHPMailer instance
$mail = new PHPMailer(true);

// * Configuring the SMTP host from gmail
$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;
$mail->Username = $adminEmail;
$mail->Password = 'SBR12345rbs';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

// * including small fix for some systems for sending the mail
include("./includes/phpMailer_fix.php");

// * Set who the message is to be sent from
$mail->setFrom('swiftbluebook10@gmail.com', 'SwiftBluebook');

// * Set who the message is to be sent to
// * as there might be multiple user matching the query so looping through every address
foreach($emailArr as $data){
    $mail->addAddress($data[$email_column], $data[$username_column]);
}
// * Set the subject line
$mail->Subject = 'Bluebook Renew Notification';

// * Read an HTML message body from an external file, convert referenced images to embedded,
// * convert HTML into a basic plain-text alternative body
$mail->msgHTML(file_get_contents('notificationMessage.html'), dirname(__FILE__));

// * Replace the plain text body with one created manually
$mail->AltBody = 'BlueBook Renew in 3 days, Thank you!!';

// * send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
}

?>