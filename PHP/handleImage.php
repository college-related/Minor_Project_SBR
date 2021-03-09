<?php

function encryptData($data, $key, $str){
    $encryption_key = base64_decode($key);
    $ivlength = substr(md5($str."users"),1, 16);
    $encryptedData = openssl_encrypt($data, "aes-256-cbc", $encryption_key, 0, $ivlength);

    return base64_encode($encryptedData.'::'.$ivlength);
}

    if(isset($_FILES['img']['name'])){
        require "./includes/connection.php";

        session_start();
        $uId = $_SESSION['uId'];

        $name = $_FILES["img"]["name"];
        $target_dir = "../ASSETS/upload/";
        $target_file = $target_dir . basename($_FILES["img"]["name"]);

        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        $extension_arr = array("jpg","jpeg", "png", "gif");

        if(in_array($imageFileType, $extension_arr)){

            $str = "/6G6F;WvK7;s{au/6G6F;WvK7;s{au";
            $key = md5($str);

            $name = encryptData($name, $key, $str);
            $command = "SELECT * FROM images WHERE uId='$uId'";
            $execute = mysqli_query($connect,$command);
            $row = mysqli_fetch_assoc($execute);
            $oldImageName = $row['image_name'];

            if(mysqli_affected_rows($connect)){
                mysqli_query(
                    $connect,
                    "UPDATE images SET image_name='$name' WHERE uId='$uId'"
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
