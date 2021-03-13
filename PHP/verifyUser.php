<?php

if(isset($_GET['activation_code'])){
    $activateCode = $_GET['activation_code'];

    require "./includes/connection.php";
    require("./includes/table_columns_name.php");

    $sql = "SELECT * FROM users WHERE $activation_column = '$activateCode'";
    $query = mysqli_query($connect, $sql);

    if(mysqli_affected_rows($connect)){
        $sql_update = "UPDATE users SET $emailVerification_column = 'verified' WHERE $activation_column = '$activateCode'";
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