<?php

if(isset($_POST['changePass'])){
    require "./includes/connection.php";
    require("./includes/table_columns_name.php");

    $uId = $_POST['uId'];
    $pass = $_POST['pass'];
    $repass = $_POST['rePass'];

    // * redirecting back if the passwords given are not same
    if($pass != $repass){
        header("location: ../PAGES/resetPassword.php?uId=$uId&error=NotSamePass");
        die();
    }

    // * hashing new password
    $newPass = password_hash($pass, PASSWORD_DEFAULT);

    $sql = "UPDATE users SET $password_column = '$newPass' WHERE uId = '$uId'";
    $res = mysqli_query($connect, $sql);

    if(mysqli_affected_rows($connect)){
        header("location: ../index.php?mssg=PassChanged#loginForm");
    }else{
        header("location: ../PAGES/resetPassword.php?error=SomeError&uId=$uId");
    }
}else{
    header("location: ../PAGES/resetPassword.php?error=IllegalWay");
}