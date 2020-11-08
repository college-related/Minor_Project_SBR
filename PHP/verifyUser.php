<?php

if(isset($_GET['activation_code'])){
    $activateCode = $_GET['activation_code'];

    require 'connection.php';

    $sql = "SELECT * FROM users WHERE ACTIVATE_CODE = '$activateCode'";
    $query = mysqli_query($connect, $sql);

    if(mysqli_affected_rows($connect)){
        $sql_update = "UPDATE users SET EMAIL_STATUS = 'verified' WHERE ACTIVATE_CODE = '$activateCode'";
        $query_update = mysqli_query($connect,$sql_update);

        if(mysqli_affected_rows($connect)){
            header("location: ../PAGES/verifiedEmail.html");
        }else{
            header("location: ../Landing.php?mssg=AlreadyVerified#loginForm");
        }
    }else{
        header("location: ../Landing.php?error=NotActivationCode#signupForm");
    }

}else{
    header("location: ../Landing.php?error=WrongLink#signupForm");
}

?>