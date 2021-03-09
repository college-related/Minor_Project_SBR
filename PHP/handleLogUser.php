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
    require "./includes/connection.php";

    $user = protect($_POST['user']);
    $Password = protect($_POST['Password']);

    $str = "/6G6F;WvK7;s{au/6G6F;WvK7;s{au";
    $key = md5($str);
    $user = encryptData($user, $key, $str);    
    $email_sql = "SELECT PASSWORD, EMAIL_STATUS, uId FROM users WHERE EMAIL = '$user';";
    $result = mysqli_query($connect, $email_sql);
    
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);

        // checking if the email is verified or not
            if($row['EMAIL_STATUS'] == "not verified"){
                header("location: ../Landing.php?error=EmailNotVerified#loginForm");
                die();
            }

        session_start();
        $_SESSION['uId'] = $row['uId'];

        if(password_verify($Password,$row['PASSWORD'])){
            header("location: ../PAGES/profile.php?Logged");
        }else{
            header("location: ../Landing.php?inputError=WrongNameORPass#loginForm");
        }
    }else{
        $username_sql = "SELECT PASSWORD, EMAIL_STATUS, uId FROM users WHERE NAME = '$user';";
        $result = mysqli_query($connect, $username_sql);

        if(mysqli_num_rows($result) > 0){
            // $row = mysqli_fetch_assoc($result);
            $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
            
            foreach($row as $data){
                // checking if the email is verified or not
                if($data['EMAIL_STATUS'] == "not verified"){
                    header("location: ../Landing.php?error=EmailNotVerified#loginForm");
                    die();
                }

                if(password_verify($Password,$data['PASSWORD'])){
                    session_start();
                    $_SESSION['uId'] = $data['uId'];

                    header("location: ../PAGES/profile.php?Logged");
                    die();
                }else{
                    header("location: ../Landing.php?inputError=WrongPass#loginForm");
                }
            }
        }else{
            header("location: ../Landing.php?inputError=WrongEmailOrUser#loginForm");
        }
    }

}else{
    header("location:../Landing.php?error=IllegalWay");
}

?>