<?php

if(isset($_POST['signup'])){


    $email = $_POST['Email'];
    $username =  $_POST['Uname'];
    $password =  $_POST['Password'];
    $confirmpassword =  $_POST['Repass'];
    $phonenumber =  $_POST['Phn'];

    if($password == $confirmpassword){
        require_once "./connection.php";

        session_start();
        $_SESSION['Uname'] = $username;

        $sql = "INSERT INTO users(USERNAME, EMAIL, PASSWORD, PHN) VALUES('$username', '$email', '$password', '$phonenumber')";

        mysqli_query($connect, $sql);

        if(mysqli_affected_rows($connect)){
            header("location: ../PAGES/profile.php?Logged");
        }else{
            header("location: ../Landing.php");
        }
    }else 
    {
        header("location:../Landing.php");
    }
}else{
    header("location:../Landing.php");
}

?>