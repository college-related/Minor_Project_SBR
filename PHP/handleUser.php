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

        if(mysqli_num_rows($query_email_check) > 0 ){
            header("location: ../Landing.php?inputError=AlreadyUserEmail#signupForm");
        }else if(mysqli_num_rows($query_phn_check) > 0){
            header("location: ../Landing.php?inputError=AlreadyUserPhone#signupForm");
        }else{
            session_start();
            $_SESSION['Uname'] = $username;
            $_SESSION['Email'] = $email;

            $sql = "INSERT INTO users(USERNAME, EMAIL, PASSWORD, PHN, ACTIVATE_CODE, EMAIL_STATUS,FIRST_TIME_USER) VALUES('$username', '$email', '$password', '$phonenumber', '$activateCode', 'not verified', 'yes')";

            mysqli_query($connect, $sql);

            if(mysqli_affected_rows($connect)){
                header("location: ./emailVerification.php");
            }else{
                header("location: ../Landing.php?error=NotInserted");
            }
        }

    }else 
    {
        header("location:../Landing.php?error=PasswordNotSame");
    }
}else{
    header("location:../Landing.php?error=IllegalWay");
}

?>