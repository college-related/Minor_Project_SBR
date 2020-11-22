<?php

function protect($data){
    return trim(strip_tags(addslashes($data)));
}

function encryptData($data, $key, $str){
    $encryption_key = base64_decode($key);
    $ivlength = substr(md5($str."users"),1, 16);
    $encryptedData = openssl_encrypt($data, "aes-256-cbc", $encryption_key, 0, $ivlength);

    return base64_encode($encryptedData.'::'.$ivlength);
}

if(isset($_POST['login'])){
    require_once "./connection.php";

    $email = protect($_POST['email']);
    $Password = protect($_POST['Password']);

    $str = $email.$Password;
    $key = md5($str);
    $email = encryptData($email, $key, $str);    
    $phn_sql = "SELECT PASSWORD, EMAIL_STATUS, uId FROM users WHERE EMAIL = '$email';";
    $result = mysqli_query($connect, $phn_sql);
    $row = mysqli_fetch_assoc($result);
    $emailStat = $row['EMAIL_STATUS'];
    $password = $row['PASSWORD'];
    $uId =$row['uId'];

    // checking if the email is verified or not
        if($emailStat == "not verified"){
            header("location: ../Landing.php?error=EmailNotVerified&logBox#loginForm");
            die();
        }

    session_start();
    $_SESSION['uId'] = $uId;

    if(password_verify($Password,$password)){
        header("location: ../PAGES/profile.php?Logged");
    }else{
        header("location: ../Landing.php?inputError=WrongNameORPass&logBox#loginForm");
    }

}else{
    header("location:../Landing.php?error=IllegalWay");
}

?>