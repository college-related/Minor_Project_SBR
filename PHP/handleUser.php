<?php

if(isset($_POST['signup'])){


    $email = $_POST['Email'];
    $username =  $_POST['Uname'];
    $password =  $_POST['Password'];
    $confirmpassword =  $_POST['Repass'];
    $phonenumber =  $_POST['Phn'];
    $activateCode = md5(rand());

    if($password == $confirmpassword){
        require_once "./connection.php";

        $sql_email_check = "SELECT * FROM users WHERE EMAIL = '$email';";
        $sql_phn_check = "SELECT * FROM users WHERE PHN = '$phonenumber';";

            $query_email_check = mysqli_query($connect, $sql_email_check);
            $query_phn_check = mysqli_query($connect, $sql_phn_check);

        if(mysqli_num_rows($query_email_check) > 0 || mysqli_num_rows($query_phn_check) > 0){
            header("location: ../Landing.php#signupForm");
        }else{
            session_start();
            $_SESSION['Uname'] = $username;
            $_SESSION['phone'] = $phonenumber;
            $_SESSION['Email'] = $email;

            $sql = "INSERT INTO users(USERNAME, EMAIL, PASSWORD, PHN, ACTIVATE_CODE, EMAIL_STATUS) VALUES('$username', '$email', '$password', '$phonenumber', '$activateCode', 'not verified')";

            mysqli_query($connect, $sql);

            if(mysqli_affected_rows($connect)){
                header("location: ./emailVerification.php");
            }else{
                header("location: ../Landing.php");
            }
        }

    }else 
    {
        header("location:../Landing.php");
    }
}else{
    header("location:../Landing.php");
}

?>