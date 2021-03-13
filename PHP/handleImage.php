<?php

if(isset($_FILES['img']['name'])){
    require "./includes/connection.php";
    include("./includes/table_columns_name.php");

    session_start();
    $uId = $_SESSION['uId'];

    $name = $_FILES["img"]["name"];
    $target_dir = "../ASSETS/upload/";
    $target_file = $target_dir . basename($_FILES["img"]["name"]);

    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    $extension_arr = array("jpg","jpeg", "png", "gif");

    if(in_array($imageFileType, $extension_arr)){
        $command = "SELECT * FROM users WHERE uId='$uId'";
        $execute = mysqli_query($connect,$command);
        $row = mysqli_fetch_assoc($execute);
        $oldImageName = $row[$image_column];

        if(mysqli_affected_rows($connect)){
            mysqli_query(
                $connect,
                "UPDATE users SET $image_column='$name' WHERE uId='$uId'"
            );
            if(mysqli_affected_rows($connect)){
                unlink($target_dir.$oldImageName);
                move_uploaded_file($_FILES['img']['tmp_name'], $target_dir.$name);
                header("location: ../PAGES/profile.php?Logged&updated");
            }else{
                header("location: ../PAGES/profile.php?Logged&error2");
            }
        }else{
            mysqli_query(
                $connect,
                "INSERT INTO images VALUES('$uId', '$name');"
            );

            if(mysqli_affected_rows($connect) > 0){
                move_uploaded_file($_FILES['img']['tmp_name'], $target_dir.$name);
                header("location: ../PAGES/profile.php?Logged&inserted");
            }else{
                header("location: ../PAGES/profile.php?Logged&error");
            }
        }

    }else{
        header("location: ../PAGES/profile.php?Logged&nottheextension");
    }
}else{
    header("location: ../PAGES/profile.php?Logged&error=IllegalWay");
}

?>
