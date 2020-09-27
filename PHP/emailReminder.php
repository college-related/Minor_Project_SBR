<?php

require 'connection.php';

$date = DATE("Y-m-d", strtotime('- 363 day'));

$sql = "SELECT EMAIL, NAME FROM users WHERE TIME_STAMP = '$date'";
$query = mysqli_query($connect, $sql);

$emailArr = mysqli_fetch_all($query, MYSQLI_ASSOC);

if(!empty($emailArr)){

require 'PHPMailer/PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;

//Set who the message is to be sent from
$mail->setFrom('swiftbluebook10@gmail.com', 'SwiftBluebook');
//Set who the message is to be sent to
foreach($emailArr as $data){
    $mail->addAddress($data['EMAIL'], $data['NAME']);
}
//Set the subject line
$mail->Subject = 'Bluebook Renew Notification';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML(file_get_contents('notificationMessage.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
$mail->AltBody = 'Hello !!!';
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