<?php

if(isset($_POST['reset-pass'])){
    require('../includes/connection.php');
    include('../includes/table_columns_name.php');

    $password = $_POST['password'];
    $password = password_hash($password, PASSWORD_DEFAULT);

    session_start();
    $uId = $_SESSION['uId'];

    $execute = mysqli_query($connect, "UPDATE users SET $password_column='$password' WHERE uId=$uId");

    if(mysqli_affected_rows($connect)){
        header('location: ../../PAGES/admin/profile.php?success=Updated');
        die();
    }else{
        header('location: ../../PAGES/admin/profile.php?error=NotUpdated');
    }

}else{
    header('location: ../../PAGES/admin/profile.php?error=IllegalWay');
}