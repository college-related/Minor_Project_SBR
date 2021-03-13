<?php

if(isset($_POST['delete-btn'])){
    require "./includes/connection.php";
    include("./includes/table_columns_name.php");

    session_start();

    $uId = $_SESSION['uId'];
    $execute = mysqli_query(
        $connect,
        "SELECT * FROM users WHERE uId='$uId'"
    );
    $row = mysqli_fetch_assoc($execute);
    $imageName = $row[$image_column];
    mysqli_query(
        $connect,
        "UPDATE users SET $image_column=NULL WHERE uId='$uId'"
    );
    if(mysqli_affected_rows($connect)){
        unlink("../ASSETS/upload/".$imageName);
        header("location: ../PAGES/profile.php?Logged&deleted");
    }else{
        header("location: ../PAGES/profile.php?Logged&error3");
    }
}else{
    header("location: ../PAGES/profile.php?Logged&error=IllegalWay");
}

?>