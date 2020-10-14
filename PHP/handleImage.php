<?php

    if(isset($_FILES['img']['name'])){
        require('./connection.php');

        session_start();
        $phn = $_SESSION['phone'];

        $name = $_FILES["img"]["name"];
        $target_dir = "../ASSETS/upload/";
        $target_file = $target_dir . basename($_FILES["img"]["name"]);

        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        $extension_arr = array("jpg","jpeg", "png", "gif");

        if(in_array($imageFileType, $extension_arr)){

            mysqli_query(
                $connect,
                "INSERT INTO images VALUES('$phn', '$name');"
            );

            if(mysqli_affected_rows($connect) > 0){
                move_uploaded_file($_FILES['img']['tmp_name'], $target_dir.$name);
                header("location: ../PAGES/profile.php?Logged&inserted");
            }else{
                header("location: ../PAGES/profile.php?Logged&error");
            }
        }else{
            header("location: ../PAGES/profile.php?Logged&nottheextension");
        }
    }else{
        header("location: ../PAGES/profile.php?Logged&error=IllegalWay");
    }

?>
