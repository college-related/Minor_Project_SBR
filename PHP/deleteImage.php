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
    
    // * updating the image name to NULL from the image name that was set on the database
    mysqli_query(
        $connect,
        "UPDATE users SET $image_column=NULL WHERE uId='$uId'"
    );

    if(mysqli_affected_rows($connect)){
        // * unlinking or deleting the photo from the uploads folder
        unlink("../ASSETS/upload/".$imageName);
        header("location: ../PAGES/profile.php?Logged&deleted");
    }else{
        header("location: ../PAGES/profile.php?Logged&error3");
    }
}else{
    header("location: ../PAGES/profile.php?Logged&error=IllegalWay");
}

?>