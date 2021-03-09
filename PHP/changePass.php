<?php

if(isset($_POST['changePass'])){
    require "./includes/connection.php";

    $uId = $_POST['uId'];
    $pass = $_POST['pass'];
    $repass = $_POST['rePass'];

    if($pass != $repass){
        header("location: ../PAGES/resetPassword.php?uId=$uId&error=NotSamePass");
        die();
    }

    $newPass = password_hash($pass, PASSWORD_DEFAULT);

    $sql = "UPDATE users SET PASSWORD = '$newPass' WHERE uId = '$uId'";
    $res = mysqli_query($connect, $sql);

    if(mysqli_affected_rows($connect)){
        header("location: ../Landing.php?mssg=PassChanged#loginForm");
    }else{
        header("location: ../PAGES/resetPassword.php?error=SomeError&uId=$uId");
    }
}else{
    header("location: ../PAGES/resetPassword.php?error=IllegalWay");
}