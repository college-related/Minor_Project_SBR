<?php

if(isset($_FILES['img']['name'])){
    require "./includes/connection.php";
    include("./includes/table_columns_name.php");

    session_start();
    $uId = $_SESSION['uId'];

    if(isset($_SESSION['role'])){
        $role = $_SESSION['role'];
    }

    // * getting the image file
    $name = $_FILES["img"]["name"];

    // * setting the target directory
    $target_dir = "../ASSETS/upload/";
    $target_file = $target_dir . basename($_FILES["img"]["name"]);

    // * extracting the image extension
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    $extension_arr = array("jpg","jpeg", "png", "gif");

    // * checking if the given file has an image extension
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
                // * unlinking the old image from the folder
                unlink($target_dir.$oldImageName);

                // * moving the new image to the target directory 
                move_uploaded_file($_FILES['img']['tmp_name'], $target_dir.$name);
                
                if($role){
                    header("location: ../PAGES/admin/admin-profile.php?updated");
                    die();
                }
                
                header("location: ../PAGES/profile.php?Logged&updated");
            }else{

                if($role){
                    header("location: ../PAGES/admin/admin-profile.php?error2");
                    die();
                }
                
                header("location: ../PAGES/profile.php?Logged&error2");
            }
        }else{
            if($role){
                header("location: ../PAGES/admin/admin-profile.php?error1");
                die();
            }

            header("location: ../PAGES/profile.php?Logged&error1");
        }

    }else{
        if($role){
            header("location: ../PAGES/admin/admin-profile.php?nottheextension");
            die();
        }

        header("location: ../PAGES/profile.php?Logged&nottheextension");
    }
}else{
    if($role){
        header("location: ../PAGES/admin/admin-profile.php?error=IllegalWay");
        die();
    }
    header("location: ../PAGES/profile.php?Logged&error=IllegalWay");
}

?>
