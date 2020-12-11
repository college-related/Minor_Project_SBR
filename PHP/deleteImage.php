<?php

if(isset($_POST['delete-btn'])){
    require('../connection.php');
    session_start();

    $uId = $_SESSION['uId'];
    $execute = mysqli_query(
        $connect,
        "SELECT * FROM images WHERE uId='$uId'"
    );
    $row = mysqli_fetch_assoc($execute);
    $imageName = $row['image_name'];
    mysqli_query(
        $connect,
        "DELETE FROM images WHERE uId='$uId'"
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